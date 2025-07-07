<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion'
    ];

    // --- Relaciones ---

    /**
     * Una materia puede ser enseñada por muchos tutores.
     * Relación: Muchos a Muchos (inverso de Tutor->belongsToMany)
     */
    public function tutores(): BelongsToMany
    {
        // Define la tabla pivote 'tutor_materia'
        return $this->belongsToMany(Tutor::class, 'tutor_materia');
    }

    /**
     * Una materia puede estar presente en muchas citas.
     * Relación: Uno a Muchos
     */
    public function citas(): HasMany
    {
        return $this->hasMany(Cita::class);
    }
}
