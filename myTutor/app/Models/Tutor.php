<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Tutor extends Model

{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * 
     */
    protected $table = 'tutores'; // indeica que la tabla para este modelo se llama tutores
    protected $fillable = [
        'user_id',
        'qr_codigo',
        'telefono',
        'bio'
    ];



    // --- Relaciones ---

    /**
     * Un perfil de tutor pertenece a un único usuario.
     * Relación: Uno a Uno (inverso de User->hasOne)
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Un tutor enseña muchas materias.
     * Relación: Muchos a Muchos
     */
    public function materias(): BelongsToMany
    {
        // Define la tabla pivote 'tutor_materia'
        return $this->belongsToMany(Materia::class, 'tutor_materia');
    }

    /**
     * Un tutor tiene muchos horarios de disponibilidad.
     * Relación: Uno a Muchos
     */
    public function horarios(): HasMany
    {
        return $this->hasMany(Horario::class);
    }

    /**
     * Un tutor tiene muchas citas agendadas.
     * Relación: Uno a Muchos
     */
    public function citas(): HasMany
    {
        return $this->hasMany(Cita::class);
    }

    /**
     * Un tutor ha recibido muchos comentarios o valoraciones.
     * Relación: Uno a Muchos
     */
    public function valoraciones(): HasMany
    {
        return $this->hasMany(Valoracion::class);
    }
}
