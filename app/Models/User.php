<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;


class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'lastname',
        'email',
        'role',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }
    /**
     * Relación con el perfil de tutor (si el usuario es tutor).
     * Un usuario puede tener un perfil de tutor.
     */
    public function tutor(): HasOne
    {
        return $this->hasOne(Tutor::class);
    }

    /**
     * Relación con las citas como estudiante.
     * Un usuario (estudiante) puede tener muchas citas agendadas.
     */
    public function citasEstudiante(): HasMany
    {
        return $this->hasMany(Cita::class, 'estudiante_id');
    }

    /**
     * Método helper para verificar si el usuario es tutor.
     */
    public function esTutor(): bool
    {
        return $this->role === 'tutor';
    }

    /**
     * Método helper para verificar si el usuario es estudiante.
     */
    public function esEstudiante(): bool
    {
        return $this->role === 'estudiante';
    }

    /**
     * Método helper para obtener todas las citas del usuario,
     * ya sea como estudiante o como tutor.
     */
    public function todasLasCitas()
    {
        if ($this->esEstudiante()) {
            return $this->citasEstudiante();
        } elseif ($this->esTutor() && $this->tutor) {
            return $this->tutor->citas();
        }

        return collect(); // Colección vacía si no es ni estudiante ni tutor
    }
}
