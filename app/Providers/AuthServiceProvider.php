<?php


use App\Models\User;
use App\Models\Cita; // ¡Importa tu modelo Cita!
use App\Policies\CitaPolicy; // ¡Importa tu CitaPolicy
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;


class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Cita::class => CitaPolicy::class, // ¡Asocia el modelo Cita con su política!
    ];

    public function boot(): void
    {

        // Esto registra automáticamente todas las policies definidas en el array $policies
        $this->registerPolicies();

        // Opcional: Si quieres Gates generales para roles, puedes mantenerlos.
        // Pero las Políticas se encargarán de la lógica de Cita.
        // Gate::define('isTutor', function (User $user) { return $user->role === 'tutor'; });
        // Gate::define('isStudent', function (User $user) { return $user->role === 'student'; });
    }
}
