<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Cita;
use Illuminate\Auth\Access\Response;

class CitaPolicy
{
    /**
     * Determine whether the user can view any citas (lists of citas).
     * Tanto estudiantes como tutores pueden ver sus propias citas.
     */
    public function viewAny(User $user): bool
    {
        // Ambos roles pueden ver listas de citas (filtradas por sus propias citas)
        return in_array($user->role, ['estudiante', 'tutor']);
    }

    /**
     * Determine whether the user can view a specific cita.
     * Solo el estudiante que la agendó o el tutor asignado pueden verla.
     */
    public function view(User $user, Cita $cita): Response
    {
        // Para estudiantes: pueden ver sus propias citas
        if ($user->role === 'estudiante' && $user->id === $cita->estudiante_id) {
            return Response::allow();
        }

        // Para tutores: necesitamos verificar si este usuario es el tutor de esta cita
        // Opción 1: Más eficiente - comparar directamente sin cargar relaciones
        if ($user->role === 'tutor' && $user->tutor && $user->tutor->id === $cita->tutor_id) {
            return Response::allow();
        }

        return Response::deny('No tienes permiso para ver esta cita.');
    }

    /**
     * Determine whether the user can create citas.
     * Solo los estudiantes pueden agendar (crear) citas.
     */
    public function create(User $user): Response
    {
        return $user->role === 'estudiante'
            ? Response::allow()
            : Response::deny('Solo los estudiantes pueden agendar citas.');
    }

    /**
     * Determine whether the user can update a specific cita.
     * Solo el tutor asignado puede modificar la cita (cambiar estado, fecha, etc.).
     */
    public function update(User $user, Cita $cita): Response
    {
        // Verificar que el usuario sea un tutor y que sea el tutor asignado a esta cita
        if ($user->role === 'tutor' && $user->tutor && $user->tutor->id === $cita->tutor_id) {
            return Response::allow();
        }

        return Response::deny('Solo el tutor asignado puede modificar esta cita.');
    }

    /**
     * Determine whether the user can delete a specific cita.
     * Tanto el tutor asignado como el estudiante que la agendó pueden eliminar la cita.
     */
    public function delete(User $user, Cita $cita): Response
    {
        // El estudiante puede eliminar sus propias citas
        // if ($user->role === 'estudiante' && $user->id === $cita->estudiante_id) {
        //     return Response::allow();
        // }

        // El tutor puede eliminar las citas asignadas a él
        if ($user->role === 'tutor' && $user->tutor && $user->tutor->id === $cita->tutor_id) {
            return Response::allow();
        }

        return Response::deny('Solo el estudiante que agendó la cita o el tutor asignado pueden eliminarla.');
    }

    /**
     * Determine whether the user can update the status of a cita.
     * Solo el tutor asignado puede cambiar el estado de la cita.
     */
    // public function updateStatus(User $user, Cita $cita): Response
    // {
    //     // Solo el tutor asignado puede cambiar el estado
    //     if ($user->role === 'tutor' && $user->tutor && $user->tutor->id === $cita->tutor_id) {
    //         return Response::allow();
    //     }

    //     return Response::deny('Solo el tutor asignado puede actualizar el estado de esta cita.');
    // }

    public function updateStatus(User $user, Cita $cita)
    {
        return $user->esTutor() && $user->tutor->id === $cita->tutor_id;
    }

    /**
     * Determine whether the user can cancel a cita.
     * Tanto el estudiante como el tutor pueden cancelar la cita.
     */
    public function cancel(User $user, Cita $cita): Response
    {
        // El estudiante puede cancelar sus propias citas
        if ($user->role === 'estudiante' && $user->id === $cita->estudiante_id) {
            return Response::allow();
        }

        // El tutor puede cancelar las citas asignadas a él
        if ($user->role === 'tutor' && $user->tutor && $user->tutor->id === $cita->tutor_id) {
            return Response::allow();
        }

        return Response::deny('Solo el estudiante que agendó la cita o el tutor asignado pueden cancelarla.');
    }

    // Métodos para restore y forceDelete (mantenemos como false si no los usas)
    public function restore(User $user, Cita $cita): bool
    {
        return false;
    }

    public function forceDelete(User $user, Cita $cita): bool
    {
        return false;
    }
}
