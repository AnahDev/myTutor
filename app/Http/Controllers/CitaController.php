<?php

namespace App\Http\Controllers;

use App\Models\Tutor;
use App\Models\Materia;
use App\Models\Cita;
use App\Models\Horario;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CitaController extends Controller
{


    public function index(Request $request)
    {
        $user = Auth::user();

        if ($user->esTutor()) {
            $tutor = $user->tutor; // Relación User -> Tutor
            $citas = Cita::with(['estudiante', 'materia', 'horario'])
                ->where('tutor_id', $tutor->id)
                ->orderBy('dia', 'desc')
                ->get();
        } else {
            $citas = Cita::with(['tutor.user', 'materia', 'horario'])
                ->where('estudiante_id', $user->id)
                ->orderBy('dia', 'desc')
                ->get();
        }

        return view('citas.index', compact('citas'));
    }

    public function create()
    {
        $tutores = User::where('role', 'estudiante')->get(); // Asumiendo que los tutores son usuarios con rol 'tutor'

        $materias = Materia::all();
        // $tutores = Tutor::all();
        $horarios = Horario::all();


        return view('citas.create', compact('materias', 'tutores', 'horarios'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'materia_id' => 'required|exists:materias,id',
            'tutor_id' => 'required|exists:tutores,id',
            // 'horario_id' => 'required|exists:horarios,id',
            'dia' => 'required|date|after:today',
            // 'hora' => 'required',
            'hora_inicio' => 'required',
            'hora_fin' => 'required',
            'nota' => 'nullable|string|max:500'
        ]);


        $horaCalculada = Carbon::parse($request->hora_inicio)->format('H:i:s');

        Cita::create([
            'estudiante_id' => $user->id,
            'tutor_id' => $request->tutor_id,
            'materia_id' => $request->materia_id,
            // 'horario_id' => $request->horario_id,
            'dia' => $request->dia,
            'hora' => $horaCalculada,
            'hora_inicio' => $request->hora_inicio,
            'hora_fin' => $request->hora_fin,
            'nota' => $request->comentarios,
            'estado' => 'pendiente'
        ]);

        return redirect()->route('citas.index')->with('success', 'Cita agendada exitosamente');
    }

    // public function destroy($id)
    // {
    //     $cita = Cita::findOrFail($id);
    //     // $user = auth()->user();
    //     $user = Auth::user();

    //     // Verificamos permisos según el rol del usuario
    //     if ($user->role === 'tutor') {
    //         // Los tutores pueden eliminar sus propias citas
    //         if ($user->id !== $cita->tutor_id) {
    //             return redirect()->back()->with('error', 'No tienes permisos para eliminar esta cita');
    //         }

    //         // Los tutores pueden eliminar citas en estados pendientes o confirmadas
    //         if (!in_array($cita->estado, ['pendiente', 'confirmada'])) {
    //             return redirect()->back()->with('error', 'No se puede eliminar una cita completada o cancelada');
    //         }

    //         return redirect()->back()->with('error', 'No tienes permisos para realizar esta acción');
    //     }


    //     $cita->delete();
    //     return redirect()->back()->with('success', 'Cita eliminada exitosamente');
    // }

    public function cancel($id)
    {
        $cita = Cita::findOrFail($id);
        $user = Auth::user();

        // Verificar que es el estudiante de la cita
        if ($user->id !== $cita->estudiante_id) {
            return redirect()->back()->with('error', 'No tienes permisos para cancelar esta cita');
        }

        // Solo se pueden cancelar citas pendientes o confirmadas
        if (!in_array($cita->estado, ['pendiente', 'confirmada'])) {
            return redirect()->back()->with('error', 'No se puede cancelar esta cita');
        }

        // Verificación de tiempo
        // $fechaCita = Carbon::parse($cita->dia . ' ' . $cita->hora_inicio);
        // if ($fechaCita->diffInHours(Carbon::now()) < 24) {
        //     return redirect()->back()->with('error', 'No puedes cancelar una cita con menos de 24 horas de anticipación');
        // }

        $cita->update(['estado' => 'cancelada']);

        return redirect()->back()->with('success', 'Cita cancelada exitosamente');
    }

    // public function updateStatus(Request $request, $id)
    // {
    //     $cita = Cita::findOrFail($id);
    //     $user = Auth::user();
    //     // $user = auth()->user();

    //     // Solo el tutor de la cita puede cambiar el estado
    //     if (!$user->esTutor() || $user->tutor->id !== $cita->tutor_id) {
    //         return redirect()->back()->with('error', 'No tienes permisos para cambiar el estado de esta cita');
    //     }

    //     $estado = $request->input('estado');
    //     if (!in_array($estado, ['confirmado', 'completado'])) {
    //         return redirect()->back()->with('error', 'Estado inválido');
    //     }

    //     $cita->estado = $estado;
    //     $cita->save();

    //     return redirect()->back()->with('success', 'Estado de la cita actualizado');
    // }

    public function updateStatus(Request $request, $id)
    {
        $cita = Cita::findOrFail($id);
        $user = Auth::user();

        if (!$user->esTutor() || $user->tutor->id !== $cita->tutor_id) {
            return redirect()->back()->with('error', 'No tienes permisos para cambiar el estado de esta cita');
        }

        $estado = $request->input('estado');
        if ($cita->estado !== 'pendiente' || $estado !== 'confirmado') {
            return redirect()->back()->with('error', 'Solo puedes confirmar citas pendientes');
        }

        $cita->estado = $estado;
        $cita->save();

        return redirect()->back()->with('success', 'Estado de la cita actualizado');
    }



    public function destroy($id)
    {
        $cita = Cita::findOrFail($id);
        $user = Auth::user();
        // $user = auth()->user();

        // Solo el tutor de la cita puede eliminar
        if (!$user->esTutor() || $user->tutor->id !== $cita->tutor_id) {
            return redirect()->back()->with('error', 'No tienes permisos para eliminar esta cita');
        }

        // Solo si la cita no está completada o cancelada
        if (in_array($cita->estado, ['completado', 'cancelado'])) {
            return redirect()->back()->with('error', 'No se puede eliminar una cita completada o cancelada');
        }

        $cita->delete();
        return redirect()->back()->with('success', 'Cita eliminada exitosamente');
    }
}
