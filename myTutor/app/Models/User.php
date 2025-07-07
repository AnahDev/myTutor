<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

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

    //RELACIONES 

    /**
     * Un usuario PUEDE tener un perfil de tutor (si su rol es 'tutor').
     * Relación: Uno a Uno
     */

    public function tutor(): HasOne
    {
        return $this->hasOne(Tutor::class);
    }

    /**
     * Un usuario (estudiante) PUEDE haber agendado varias citas.
     * Relación: Uno a Muchos
     */
    public function estudianteCita(): HasMany
    {
        return $this->hasMany(Cita::class); // Especifica la FK
    }

    /**
     * Un usuario (estudiante) PUEDE haber dejado varios feedback.
     * Relación: Uno a Muchos
     */
    public function estudianteValoracion(): HasMany
    {
        return $this->hasMany(Valoracion::class);
    }
}
