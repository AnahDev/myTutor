<?php
// routes/api.php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Materia;
use App\Models\Tutor;
use App\Models\Cita;
use App\Http\Controllers\TutorController;

/*
|--------------------------------------------------------------------------
| Rutas API para el sistema de citas
|--------------------------------------------------------------------------
| Estas rutas manejan las peticiones AJAX desde el formulario de citas
| Están organizadas de manera lógica y siguen las convenciones REST
*/

// Ruta para obtener tutores filtrados por materia
// Esta ruta se llama cuando el usuario selecciona una materia en el formulario
Route::get('/materias/{materia}/tutores', function (Materia $materia) {
    try {
        // Cargamos los tutores de la materia junto con la información del usuario
        // Asumiendo que tienes una relación many-to-many entre materias y tutores
        // $tutores = $materia->tutores()->with('user')->get();

        // Si no hay relación directa, puedes usar:
        $tutores = Tutor::whereHas('materias', function ($query) use ($materia) {
            $query->where('materia_id', $materia->id);
        })->with('user')->get();

        // Formateamos la respuesta para que sea compatible con el JavaScript
        $respuesta = $tutores->map(function ($tutor) {
            return [
                'id' => $tutor->id,
                'name' => $tutor->user->name, // Nombre del usuario asociado al tutor
                // 'email' => $tutor->user->email,
                // 'especialidad' => $tutor->especialidad ?? 'Sin especialidad definida'
            ];
        });

        return response()->json($respuesta);
    } catch (\Exception $e) {
        // Manejo de errores para debugging
        return response()->json([
            'error' => 'Error al cargar tutores',
            'message' => $e->getMessage()
        ], 500);
    }
});

// Ruta para obtener horarios disponibles de un tutor en una fecha específica
// Esta se llama cuando el usuario selecciona un tutor y una fecha
Route::get('/tutores/{tutor}/horarios-disponibles', function (Tutor $tutor, Request $request) {
    try {
        $fecha = $request->query('fecha');

        // Validación de entrada
        if (!$fecha) {
            return response()->json(['error' => 'La fecha es requerida'], 400);
        }

        // Validar que la fecha no sea pasada
        if (\Carbon\Carbon::parse($fecha)->isPast()) {
            return response()->json(['error' => 'No se pueden agendar citas en fechas pasadas'], 400);
        }

        // 1. Obtener el día de la semana de la fecha seleccionada
        $numeroDiaSemana = \Carbon\Carbon::parse($fecha)->dayOfWeek;
        $dias = ['domingo', 'lunes', 'martes', 'miercoles', 'jueves', 'viernes', 'sabado'];
        $nombreDiaSemana = $dias[$numeroDiaSemana];

        // 2. Obtener los horarios base del tutor para ese día de la semana
        $horariosBase = $tutor->horarios()
            ->where('dia_semana', $nombreDiaSemana)
            ->where('activo', true) // Asumiendo que tienes un campo para horarios activos
            ->pluck('hora_inicio')
            ->map(function ($hora) {
                return date('H:i', strtotime($hora));
            })
            ->toArray();

        // 3. Obtener las citas ya agendadas para ese día y tutor
        $citasAgendadas = $tutor->citas()
            ->where('dia', $fecha)
            ->whereIn('estado', ['pendiente', 'confirmada']) // Solo citas activas
            ->pluck('hora')
            ->map(function ($hora) {
                return date('H:i', strtotime($hora));
            })
            ->toArray();

        // 4. Filtrar horarios disponibles (excluir los ya agendados)
        $horariosDisponibles = array_diff($horariosBase, $citasAgendadas);

        // 5. Formatear la respuesta para el frontend
        $respuesta = [];
        foreach ($horariosDisponibles as $hora) {
            $respuesta[] = [
                'hora' => $hora,
                'hora_formateada' => \Carbon\Carbon::createFromFormat('H:i', $hora)->format('h:i A')
            ];
        }

        // Ordenar por hora para mejor UX
        usort($respuesta, function ($a, $b) {
            return strcmp($a['hora'], $b['hora']);
        });

        return response()->json($respuesta);
    } catch (\Exception $e) {
        return response()->json([
            'error' => 'Error al cargar horarios',
            'message' => $e->getMessage()
        ], 500);
    }
});

// Ruta adicional para verificar disponibilidad de una hora específica
// Útil para validaciones en tiempo real
Route::get('/tutores/{tutor}/verificar-disponibilidad', function (Tutor $tutor, Request $request) {
    $fecha = $request->query('fecha');
    $hora = $request->query('hora');

    if (!$fecha || !$hora) {
        return response()->json(['error' => 'Fecha y hora son requeridas'], 400);
    }

    // Verificar si ya existe una cita en esa fecha y hora
    $citaExistente = $tutor->citas()
        ->where('dia', $fecha)
        ->where('hora', $hora)
        ->whereIn('estado', ['pendiente', 'confirmada'])
        ->exists();

    return response()->json([
        'disponible' => !$citaExistente,
        'mensaje' => $citaExistente ? 'Horario no disponible' : 'Horario disponible'
    ]);
});
