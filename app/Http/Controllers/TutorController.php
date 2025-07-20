<?php

namespace App\Http\Controllers;

use App\Models\Materia;
use App\Models\Tutor;
use App\Models\Cita;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Exception;
// use Illuminate\Container\Attributes\Auth;
use Illuminate\Support\Facades\Auth;

class TutorController extends Controller
{

    public function index()
    {
        // Lógica para mostrar todos los tutores...
        $tutores = Tutor::with('user', 'materias')->get();
        return view('tutores.index', compact('tutores'));
    }


    public function store(Request $request)
    {
        // Validar los datos
        $request->validate([
            'telefono' => 'required|string|max:20',
            'bio' => 'nullable|string|max:500',
            'qr_codigo' => 'nullable|string|max:255',
        ]);

        // Crear el perfil de tutor solo si no existe
        $user = Auth::user();
        // if ($user->tutor) {
        //     return redirect()->back()->with('error', 'Ya tienes un perfil de tutor.');
        // }

        Tutor::create([
            'user_id' => $user->id,
            'telefono' => $request->telefono,
            'bio' => $request->bio,
            'qr_codigo' => $request->qr_codigo,
        ]);

        return redirect()->route('tutores.index')->with('success', 'Perfil de tutor creado correctamente.');
    }
    public function show(Tutor $tutor)
    {
        // Lógica para mostrar un tutor...
    }


    public function create()
    {
        // Solo muestra el formulario si el usuario no tiene perfil de tutor
        $user = Auth::user();
        if ($user->tutor) {
            return redirect()->route('dashboard')->with('error', 'Ya tienes un perfil de tutor.');
        }
        return view('tutores.create');
    }


    public function destroy()
    {
        $user = Auth::user();
        if (!$user->tutor) {
            return redirect()->route('dashboard')->with('error', 'No tienes perfil de tutor para eliminar.');
        }

        $user->tutor->delete();

        return redirect()->route('dashboard')->with('success', 'Perfil de tutor eliminado correctamente.');
    }

    /**
     * Obtiene los tutores disponibles para una materia específica
     * Esta función es llamada por la ruta API /api/materias/{materia}/tutores
     */
    public function getTutoresPorMateria(Materia $materia)
    {
        try {
            // Opción 1: Si tienes una relación directa many-to-many entre materias y tutores
            $tutores = $materia->tutores()->with('user')->get();

            // Opción 2: Si la relación es a través de una tabla intermedia
            // $tutores = Tutor::whereHas('materias', function($query) use ($materia) {
            //     $query->where('materia_id', $materia->id);
            // })->with('user')->get();

            // Opción 3: Si los tutores tienen una columna materia_id directamente
            // $tutores = Tutor::where('materia_id', $materia->id)->with('user')->get();

            // Formatear la respuesta para el frontend
            $respuesta = $tutores->map(function ($tutor) {
                return [
                    'id' => $tutor->id,
                    'name' => $tutor->user->name,
                    'email' => $tutor->user->email,
                    'especialidad' => $tutor->especialidad ?? 'Sin especialidad definida',
                    // Agregar más campos si es necesario
                    'telefono' => $tutor->telefono ?? null,
                    'activo' => $tutor->activo ?? true
                ];
            });

            return response()->json($respuesta);
        } catch (\Exception $e) {
            // Log del error para debugging
            Log::error('Error al obtener tutores por materia: ' . $e->getMessage());

            return response()->json([
                'error' => 'Error al cargar tutores',
                'message' => config('app.debug') ? $e->getMessage() : 'Error interno del servidor'
            ], 500);
        }
    }

    /**
     * Obtiene los horarios disponibles de un tutor para una fecha específica
     * Esta función es llamada por la ruta API /api/tutores/{tutor}/horarios-disponibles
     */
    // public function getHorariosDisponibles(Tutor $tutor, Request $request)
    // {
    //     try {
    //         // Validar que la fecha esté presente
    //         $fecha = $request->query('fecha');
    //         if (!$fecha) {
    //             return response()->json(['error' => 'La fecha es requerida'], 400);
    //         }

    //         // Validar formato de fecha
    //         try {
    //             $fechaCarbon = Carbon::parse($fecha);
    //         } catch (\Exception $e) {
    //             return response()->json(['error' => 'Formato de fecha inválido'], 400);
    //         }

    //         // Validar que la fecha no sea pasada
    //         if ($fechaCarbon->isPast()) {
    //             return response()->json(['error' => 'No se pueden agendar citas en fechas pasadas'], 400);
    //         }

    //         // 1. Obtener el día de la semana de la fecha seleccionada
    //         $numeroDiaSemana = $fechaCarbon->dayOfWeek;
    //         $dias = ['domingo', 'lunes', 'martes', 'miercoles', 'jueves', 'viernes', 'sabado'];
    //         $nombreDiaSemana = $dias[$numeroDiaSemana];

    //         // 2. Obtener los horarios base del tutor para ese día de la semana
    //         $horariosBase = $tutor->horarios()
    //             ->where('dia_semana', $nombreDiaSemana)
    //             ->where('activo', true) // Asumiendo que tienes un campo activo
    //             ->orderBy('hora_inicio')
    //             ->get();

    //         // Si no hay horarios para ese día
    //         if ($horariosBase->isEmpty()) {
    //             return response()->json([]);
    //         }

    //         // 3. Obtener las citas ya agendadas para ese día y tutor
    //         $citasAgendadas = $tutor->citas()
    //             ->where('dia', $fecha)
    //             ->whereIn('estado', ['pendiente', 'confirmada']) // Solo citas activas
    //             ->pluck('hora')
    //             ->map(function ($hora) {
    //                 return date('H:i', strtotime($hora));
    //             })
    //             ->toArray();

    //         // 4. Filtrar horarios disponibles
    //         $horariosDisponibles = [];

    //         foreach ($horariosBase as $horario) {
    //             $horaInicio = date('H:i', strtotime($horario->hora_inicio));

    //             // Verificar si esta hora no está ocupada
    //             if (!in_array($horaInicio, $citasAgendadas)) {
    //                 $horariosDisponibles[] = [
    //                     'hora' => $horaInicio,
    //                     'hora_formateada' => Carbon::createFromFormat('H:i', $horaInicio)->format('h:i A'),
    //                     'duracion' => $horario->duracion ?? 60, // Duración en minutos
    //                     'id_horario' => $horario->id
    //                 ];
    //             }
    //         }

    //         return response()->json($horariosDisponibles);
    //     } catch (\Exception $e) {
    //         Log::error('Error al obtener horarios disponibles: ' . $e->getMessage());

    //         return response()->json([
    //             'error' => 'Error al cargar horarios',
    //             'message' => config('app.debug') ? $e->getMessage() : 'Error interno del servidor'
    //         ], 500);
    //     }
    // }

    /**
     * Verifica si un horario específico está disponible
     * Esta función es llamada por la ruta API /api/tutores/{tutor}/verificar-disponibilidad
     */
    // public function verificarDisponibilidad(Tutor $tutor, Request $request)
    // {
    //     try {
    //         $fecha = $request->query('fecha');
    //         $hora = $request->query('hora');

    //         if (!$fecha || !$hora) {
    //             return response()->json(['error' => 'Fecha y hora son requeridas'], 400);
    //         }

    //         // Verificar si ya existe una cita en esa fecha y hora
    //         $citaExistente = $tutor->citas()
    //             ->where('dia', $fecha)
    //             ->where('hora', $hora)
    //             ->whereIn('estado', ['pendiente', 'confirmada'])
    //             ->exists();

    //         // También verificar si el tutor tiene horario disponible en ese día y hora
    //         $fechaCarbon = Carbon::parse($fecha);
    //         $numeroDiaSemana = $fechaCarbon->dayOfWeek;
    //         $dias = ['domingo', 'lunes', 'martes', 'miercoles', 'jueves', 'viernes', 'sabado'];
    //         $nombreDiaSemana = $dias[$numeroDiaSemana];

    //         $horarioExiste = $tutor->horarios()
    //             ->where('dia_semana', $nombreDiaSemana)
    //             ->where('hora_inicio', $hora)
    //             ->where('activo', true)
    //             ->exists();

    //         $disponible = !$citaExistente && $horarioExiste;

    //         return response()->json([
    //             'disponible' => $disponible,
    //             'mensaje' => $disponible ? 'Horario disponible' : 'Horario no disponible'
    //         ]);
    //     } catch (\Exception $e) {
    //         Log::error('Error al verificar disponibilidad: ' . $e->getMessage());

    //         return response()->json([
    //             'error' => 'Error al verificar disponibilidad',
    //             'message' => config('app.debug') ? $e->getMessage() : 'Error interno del servidor'
    //         ], 500);
    //     }
    // }
}
