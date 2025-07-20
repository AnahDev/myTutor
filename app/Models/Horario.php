<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Horario extends Model
{
    use HasFactory;


    protected $fillable = [
        'tutor_id',
        'dia',
        'hora_inicio',
        'hora_fin'
    ];

    protected function casts(): array
    {
        return [
            'hora_inicio' => 'datetime', // Cast a objeto Carbon para fácil manipulación de tiempo
            'hora_fin' => 'datetime',   // (Solo si la columna es TIME, si es DATETIME, es 'datetime')
        ];
    }

    // --- Relaciones ---

    /**
     * Un horario pertenece a un único tutor.
     * Relación: Uno a Muchos (inverso de Tutor->hasMany)
     */
    public function tutor(): BelongsTo
    {
        return $this->belongsTo(Tutor::class);
    }

    /**
     * Un horario puede estar asociado a muchas citas.
     * Relación: Uno a Muchos
     */
    public function citas(): HasMany
    {
        return $this->hasMany(Cita::class);
    }
}
