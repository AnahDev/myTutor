<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('horarios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tutor_id')->constrained('tutores')->onDelete('cascade');
            $table->string('dia');
            $table->time('hora_inicio');
            $table->time('hora_fin');
            $table->unique(['tutor_id', 'dia', 'hora_inicio', 'hora_fin']); //para que no choquen las horas ,ni el dia

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('horarios');
    }
};
