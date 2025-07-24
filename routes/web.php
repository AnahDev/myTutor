<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CitaController;
// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TutorController;
use App\Http\Controllers\TutorMateriaController;
use App\Http\Controllers\QrController;




Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/tutor/public-profile/{user}', [QrController::class, 'show'])
    ->name('tutor.public_profile');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');



    // Rutas principales para gestión de citas
    // Laravel automáticamente aplica las policies cuando usas Resource Controllers
    Route::resource('citas', CitaController::class);

    Route::resource('tutores', TutorController::class);

    // Alternativamente, puedes usar Route::resource para crear todas las rutas RESTful automáticamente:
    // Route::resource('tutor.materias', TutorMateriaController::class)->middleware('auth');

    // Rutas adicionales para acciones específicas
    Route::patch('citas/{cita}/status', [CitaController::class, 'updateStatus'])
        ->name('citas.update-status');

    Route::patch('citas/{cita}/cancel', [CitaController::class, 'cancel'])
        ->name('citas.cancel');

    // Ruta para obtener horarios de un tutor específico (útil para AJAX)
    Route::get('api/tutores/{tutor}/horarios', function ($tutor) {
        $tutorModel = \App\Models\Tutor::findOrFail($tutor);
        return response()->json($tutorModel->horarios);
    })->name('api.tutores.horarios');




    Route::get('/materias/{materia}/tutores', [TutorController::class, 'getTutoresPorMateria']);

    ####################################

    // Route::middleware(['auth'])->group(function () {

    // Rutas para gestión de materias del tutor
    Route::prefix('tutor')->name('tutor.')->group(function () {

        // Mostrar las materias del tutor y formulario para agregar
        Route::get('/materias', [TutorMateriaController::class, 'index'])->name('materias.index');
        Route::get('/materias/create', [TutorMateriaController::class, 'create'])->name('materias.create');
        Route::get('/materias/{materia}/edit', [TutorMateriaController::class, 'edit'])->name('materias.edit');
        Route::put('/materias/{materia}', [TutorMateriaController::class, 'update'])->name('materias.update');

        // Agregar una materia al tutor
        Route::post('/materias', [TutorMateriaController::class, 'store'])->name('materias.store');

        // Eliminar una materia del tutor
        Route::delete('/materias/{materia}', [TutorMateriaController::class, 'destroy'])->name('materias.destroy');

        // Ruta alternativa para agregar múltiples materias (opcional)
        Route::post('/materias/multiple', [TutorMateriaController::class, 'storeMultiple'])->name('materias.store.multiple');

        Route::get('/tutor/citas', [CitaController::class, 'misCitas'])->name('citas.tutor');
    });
    // });

    Route::get('comunidad', function () {
        return view('comunidad');
    })->name('comunidad');

    Route::get('perfil/qr', [QrController::class, 'generateQr'])->name('qr.generate');






    /*
|--------------------------------------------------------------------------
| Rutas API internas
|--------------------------------------------------------------------------
| Estas rutas se usan para las peticiones AJAX del frontend
| Están separadas de las rutas API públicas en routes/api.php
*/

    // Rutas API para el formulario de citas (estas son las que necesitas agregar)
    Route::prefix('api')->middleware('auth')->group(function () {

        // Obtener tutores por materia
        Route::get('/materias/{materia}/tutores', [TutorController::class, 'getTutoresPorMateria']);

        // // Obtener horarios disponibles de un tutor
        // Route::get('/tutores/{tutor}/horarios-disponibles', [TutorController::class, 'getHorariosDisponibles']);

        // // Verificar disponibilidad de un horario específico
        // Route::get('/tutores/{tutor}/verificar-disponibilidad', [TutorController::class, 'verificarDisponibilidad']);

        // Obtener información de una materia
        Route::get('/materias/{materia}', function (App\Models\Materia $materia) {
            return response()->json([
                'id' => $materia->id,
                'nombre' => $materia->nombre,
                'descripcion' => $materia->descripcion,
                'activa' => $materia->activa ?? true
            ]);
        });

        // Obtener información de un tutor
        Route::get('/tutores/{tutor}', function (App\Models\Tutor $tutor) {
            return response()->json([
                'id' => $tutor->id,
                'nombre' => $tutor->user->name,
                'email' => $tutor->user->email,
                'especialidad' => $tutor->especialidad,
                'activo' => $tutor->activo ?? true
            ]);
        });
    });
});

require __DIR__ . '/auth.php';


// Explicación de cómo funciona la autorización automática:
/*
Laravel automáticamente conecta los métodos de tu Policy con las acciones del Resource Controller:

- GET /citas → index() → viewAny policy method
- GET /citas/create → create() → create policy method  
- POST /citas → store() → create policy method
- GET /citas/{cita} → show() → view policy method
- GET /citas/{cita}/edit → edit() → update policy method
- PUT/PATCH /citas/{cita} → update() → update policy method
- DELETE /citas/{cita} → destroy() → delete policy method

Para métodos personalizados como updateStatus() y cancel(), necesitas llamar manualmente 
$this->authorize() en el controlador, como lo hicimos arriba.
*/
