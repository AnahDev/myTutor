<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
// use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Valoracion extends Model
{
    use HasFactory;
    protected $fillable = [
        'cita_id',
        'tutor_id',
        'estudiante_id',
        'rating',
        'comentario'
    ];


    // --- Relaciones ---

    /**
     * Una valoracion pertenece a una única cita.
     * Relación: Uno a Uno (inverso de Appointment->hasOne)
     */
    public function cita(): BelongsTo
    {
        return $this->belongsTo(Cita::class);
    }

    /**
     * Una valoracion es dejada por un único estudiante (usuario).
     * Relación: Uno a Muchos (inverso de User->hasMany studentFeedback)
     */
    public function estudiante(): BelongsTo
    {
        return $this->belongsTo(User::class); // Especifica la FK
    }

    /**
     * Una valoracion es dada a un tutor.
     * Relación: Uno a Muchos (inverso de Tutor->hasMany feedback)
     */
    public function tutor(): BelongsTo
    {
        return $this->belongsTo(Tutor::class);
    }
}
