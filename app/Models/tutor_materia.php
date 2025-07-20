<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;



class tutor_materia extends Model
{
    use HasFactory;

    protected $table = 'tutor_materia';
    protected $fillable = [
        'tutor_id',
        'materia_id'
    ];


    //relaciones
    public function tutor(): BelongsTo
    {
        return $this->belongsTo(Tutor::class);
    }

    public function materia(): BelongsTo
    {
        return $this->belongsTo(Materia::class);
    }
}
