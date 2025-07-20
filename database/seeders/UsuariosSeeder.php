<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Horario;
use App\Models\Materia;
use App\Models\Tutor;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class UsuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // --- 1. Crear Usuario Estudiante ---
        $estudianteUser = User::create([
            'name' => 'Luis',
            'lastname' => 'Perez',
            'email' => 'estudiante@demo.com',
            'password' => Hash::make('demo123'), // Contraseña: 'password'
            'role' => 'estudiante',
        ]);
        $this->command->info('Usuario Estudiante creado: ' . $estudianteUser->email);


        // --- 2. Crear Usuario Tutor y su Perfil de Tutor ---
        $tutorUser = User::create([
            'name' => 'Ana',
            'lastname' => 'Santamaria',
            'email' => 'tutor@demo.com',
            'password' => Hash::make('demo321'), // Contraseña: 'password'
            'role' => 'tutor',
        ]);
        $this->command->info('Usuario Tutor creado: ' . $tutorUser->email);

        $tutorPerfil = Tutor::create([
            'user_id' => $tutorUser->id,
            'qr_codigo' => (string) Str::uuid(), // Genera un ID único para el QR
            'telefono' => '+584121234567',
            'bio' => 'Tutor experimentado en matemáticas y física.',
        ]);
        $this->command->info('Perfil de Tutor asociado al Usuario Tutor.');


        // --- 3. Poblar Materias ---
        // Solo si no tienes materias ya creadas
        $math = Materia::firstOrCreate(['nombre' => 'Matemáticas', 'descripcion' => 'Matemáticas I']);
        $physics = Materia::firstOrCreate(['nombre' => 'Física', 'descripcion' => 'Tema:MRU']);
        $chemistry = Materia::firstOrCreate(['nombre' => 'Química', 'descripcion' => 'Quimica']);
        $this->command->info('Materias creadas/verificadas.');


        // --- 4. Asociar Materias al Tutor (Tabla Pivote: tutor_subject) ---
        $tutorPerfil->materias()->attach([$math->id, $physics->id]);
        $this->command->info('Materias asociadas al Tutor.');


        // --- 5. Añadir Horarios al Tutor ---
        Horario::create([
            'tutor_id' => $tutorPerfil->id,
            'dia' => 'Lunes',
            'hora_inicio' => '10:00:00',
            'hora_fin' => '12:00:00',
        ]);
        Horario::create([
            'tutor_id' => $tutorPerfil->id,
            'dia' => 'Miércoles',
            'hora_inicio' => '14:00:00',
            'hora_fin' => '16:00:00',
        ]);
        $this->command->info('Horarios creados para el Tutor.');


        // --- OPCIONAL: Crear una Cita de Prueba (por ejemplo, pendiente) ---
        // Asegúrate de que las fechas y horas sean en el futuro para que el estado 'pending' tenga sentido
        // Y que el schedule_id sea válido si lo usas
        $horario = Horario::where('tutor_id', $tutorPerfil->id)->first(); // Toma el primer horario para la prueba

        if ($horario) {
            \App\Models\Cita::create([
                'estudiante_id' => $estudianteUser->id,
                'tutor_id' => $tutorPerfil->id,
                'materia_id' => $math->id,
                'horario_id' => $horario->id,
                'dia' => now()->addDays(rand(1, 7))->format('Y-m-d'), // Fecha futura
                'hora' => $horario->hora_inicio, // Hora del horario
                'estado' => 'pendiente',
                'nota' => 'Tutoría de prueba para funciones de confirmación.',
            ]);
            $this->command->info('Cita de prueba pendiente creada.');
        } else {
            $this->command->warn('No se pudo crear una cita de prueba porque no hay horarios disponibles para el tutor.');
        }
    }
}
