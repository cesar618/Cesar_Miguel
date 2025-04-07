<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SupportStaffController;
use App\Http\Controllers\ActorController;
use App\Http\Controllers\ProducerController;
use App\Http\Controllers\CharacterController;
use App\Http\Controllers\PlayController; // Importamos PlayController
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\LocationsController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\CalendarController;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
    ]);
})->name('welcome');


// ··· NUEVA CONFIGURACION DE RUTAS ···
// Rutas para cualquier usuario AUTENTICADO (checker, operator, admin)
Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->middleware('verified')->name('dashboard');

    // Rutas de perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // vista de personajes
    Route::get('/characters', [CharacterController::class, 'index'])->name('characters.index');


});

//Rutas solo para ADMIN o también para OPERATOR
Route::middleware(['auth', 'role:admin|operator'])->group(function () {
    // Rutas de actores
    Route::get('/actores', [ActorController::class, 'index'])->name('actores.index');
    Route::get('/actores/crear', [ActorController::class, 'create'])->name('actores.create');
    Route::post('/actores', [ActorController::class, 'store'])->name('actores.store');
    Route::get('/actoresRuta', [ActorController::class, 'mostrarActores'])->name('actorcontroller.mostrarActores');
    Route::get('/actores/{id}/editar', [ActorController::class, 'edit'])->name('actores.edit');
    Route::put('/actores/{id}', [ActorController::class, 'update'])->name('actores.update');
    Route::post('/actores/{id}', [ActorController::class, 'update']); // Mantener compatibilidad
    Route::delete('/actores/{id}', [ActorController::class, 'destroy'])->name('actores.destroy');
    
    // Rutas de productoras
    Route::get('/productoras', [ProducerController::class, 'index'])->name('productoras.index');
    Route::get('/productoras/crear', [ProducerController::class, 'create'])->name('productoras.create');
    Route::post('/productoras', [ProducerController::class, 'store'])->name('productoras.store');
    Route::get('/rutaProductoras', [ProducerController::class, 'mostrarProductores'])->name('productoras.mostrarProductoras');
    Route::get('/productoras/{id}/editar', [ProducerController::class, 'edit'])->name('productoras.edit');
    Route::put('/productoras/{id}', [ProducerController::class, 'update'])->name('productoras.update');
    Route::post('/productoras/{id}', [ProducerController::class, 'update']); // Soporte para POST con _method=PUT
    Route::delete('/productoras/{id}', [ProducerController::class, 'destroy'])->name('productoras.destroy');

    // Rutas de personajes
    Route::get('/characters/crear', [CharacterController::class, 'create'])->name('characters.create');
    Route::post('/characters', [CharacterController::class, 'store'])->name('characters.store');
    Route::get('/charactersRuta', [CharacterController::class, 'mostrarCharacters'])->name('charactercontroller.mostrarCharacters');
    Route::get('/characters/{character}/editar', [CharacterController::class, 'edit'])->name('characters.edit');
    Route::get('/characters/{character}/editar', [CharacterController::class, 'edit'])->name('characters.edit');
    Route::put('/characters/{character}', [CharacterController::class, 'update'])->name('characters.update');
    Route::post('/characters/{character}', [CharacterController::class, 'update']);
    Route::delete('/characters/{character}', [CharacterController::class, 'destroy'])->name('characters.destroy');
    
    // Rutas de obras (Plays)
    Route::resource('obras', PlayController::class);
    Route::delete('/obras/{play}/characters/{character}', [\App\Http\Controllers\PlayController::class, 'removeCharacter'])
    ->name('obras.removeCharacter');

    // Rutas staffsoporte
    //Listado
    Route::get('/staff-soporte', [SupportStaffController::class, 'index'])->name('staff.index');
    // Formulario de creación
    Route::get('/staff-soporte/create', [SupportStaffController::class, 'create'])->name('staff.create');
    // Guardar nuevo registro
    Route::post('/staff-soporte', [SupportStaffController::class, 'store'])->name('staff.store');
    // Formulario de edición
    Route::get('/staff-soporte/{id}/edit', [SupportStaffController::class, 'edit'])->name('staff.edit');
    // Actualizar registro
    Route::put('/staff-soporte/{id}', [SupportStaffController::class, 'update'])->name('staff.update');
    // Eliminar registro
    Route::delete('/staff-soporte/{id}', [SupportStaffController::class, 'destroy'])->name('staff.destroy');

    Route::get('/eventos', [EventsController::class, 'index'])->name('events.index');
    Route::get('/eventos/crear', [EventsController::class, 'create'])->name('events.create');
    Route::post('/eventos', [EventsController::class, 'store'])->name('events.store');
    Route::get('/eventos/{event}/editar', [EventsController::class, 'edit'])->name('events.edit');
    Route::put('/eventos/{event}', [EventsController::class, 'update'])->name('events.update');
    Route::delete('/eventos/{event}', [EventsController::class, 'destroy'])->name('events.destroy');


    Route::get('/location', [LocationsController::class, 'index'])->name('location.index');
    Route::get('/location/create', [LocationsController::class, 'create'])->name('locations.create');
    Route::post('/location', [LocationsController::class, 'store'])->name('locations.store');
    Route::get('/location/{location}/edit', [LocationsController::class, 'edit'])->name('locations.edit');
    Route::put('/location/{location}', [LocationsController::class, 'update'])->name('locations.update');
    Route::delete('/location/{location}', [LocationsController::class, 'destroy'])->name('locations.destroy');


    Route::prefix('eventos/{eventId}/staff')->group(function () {
        Route::get('/', [StaffController::class, 'index'])->name('staff.index');
        Route::get('/crear', [StaffController::class, 'create'])->name('staff.create');
        Route::post('/', [StaffController::class, 'store'])->name('staff.store');
        Route::get('/{staffId}/editar', [StaffController::class, 'edit'])->name('staff.edit');
        Route::put('/{staffId}', [StaffController::class, 'update'])->name('staff.update');
        Route::delete('/{staffId}', [StaffController::class, 'destroy'])->name('staff.destroy');
    });

    Route::get('/calendar', [CalendarController::class, 'index'])->name('calendar.index');
    Route::get('/calendar/events', [CalendarController::class, 'events'])->name('calendar.events');
    Route::post('/calendar/events', [CalendarController::class, 'store'])->name('calendar.store');
    Route::put('/calendar/events/{event}', [CalendarController::class, 'update'])->name('calendar.update');




    

});

// Rutas EXCLUSIVAS para ADMIN
Route::middleware(['auth', 'role:admin'])->group(function () {

    // OJO AQUI COLOCAREMOS LA ADMINISTRACION DE USUARIOS ----> ABM USUARIOS
});


require __DIR__ . '/auth.php';
require __DIR__ . '/preview.php';