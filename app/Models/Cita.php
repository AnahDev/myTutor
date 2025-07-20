<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
// use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    use HasFactory;
    protected $fillable = [
        'estudiante_id',
        'tutor_id',
        'materia_id',
        'horario_id',
        'dia',
        'hora',
        'hora_inicio',
        'hora_fin',
        'estado',
        'nota'
    ];


    protected function casts(): array
    {
        return [
            'dia' => 'date',   // Cast a objeto Carbon para fechas
            // 'hora' => 'datetime',
            'hora_inicio' => 'datetime',
            'hora_fin' => 'datetime',   // Cast a objeto Carbon para horas
        ];
    }

    // --- Relaciones ---

    /**
     * Una cita pertenece a un único estudiante (usuario).
     * Relación: Uno a Muchos (inverso de User->hasMany studentAppointments)
     */
    public function estudiante(): BelongsTo
    {
        return $this->belongsTo(User::class, 'estudiante_id'); // Especifica la FK
    }

    /**
     * Una cita pertenece a un único tutor.
     * Relación: Uno a Muchos (inverso de Tutor->hasMany)
     */
    public function tutor(): BelongsTo
    {
        return $this->belongsTo(Tutor::class, 'tutor_id');
    }

    /**
     * Una cita pertenece a una única materia.
     * Relación: Uno a Muchos (inverso de Subject->hasMany)
     */
    public function materia(): BelongsTo
    {
        return $this->belongsTo(Materia::class);
    }

    /**
     * Una cita puede estar vinculada a un horario específico (opcional, si el horario original fue eliminado, puede ser null).
     * Relación: Uno a Muchos (inverso de Schedule->hasMany)
     */
    public function horario(): BelongsTo
    {
        return $this->belongsTo(Horario::class);
    }

    /**
     * Una cita PUEDE tener un único feedback (valoración).
     * Relación: Uno a Uno (ya que en la migración de feedback pusimos unique('appointment_id'))
     */
    public function valoracion(): HasOne
    {
        return $this->hasOne(Valoracion::class);
    }
}
