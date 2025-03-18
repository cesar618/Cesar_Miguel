<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ActorController;
use App\Http\Controllers\ProducerController;
use App\Http\Controllers\CharacterController;
use App\Http\Controllers\PlayController; // Importamos PlayController
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
    ]);
})->name('welcome');

// Todas las rutas autenticadas en un solo grupo
Route::middleware('auth')->group(function () 
{
    // Dashboard
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->middleware('verified')->name('dashboard');

    // Rutas de perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rutas de actores
    Route::get('/actores', [ActorController::class, 'index'])->name('actores.index');
    Route::get('/actores/crear', [ActorController::class, 'create'])->name('actores.create');
    Route::post('/actores', [ActorController::class, 'store'])->name('actores.store');
    Route::get('/actoresRuta', [ActorController::class, 'mostrarActores'])->name('actorcontroller.mostrarActores');
    Route::get('/actores/{id}/editar', [ActorController::class, 'edit'])->name('actores.edit');
    Route::put('/actores/{id}', [ActorController::class, 'update'])->name('actores.update');
Route::post('/actores/{id}', [ActorController::class, 'update']); // Mantener compatibilidad
    Route::delete('/actores/{id}', [ActorController::class, 'destroy'])->name('actores.destroy');
    // ... otras rutas ...

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
   
    
    Route::get('/characters', [CharacterController::class, 'index'])->name('characters.index');
    Route::get('/characters/crear', [CharacterController::class, 'create'])->name('characters.create');
    Route::post('/characters', [CharacterController::class, 'store'])->name('characters.store');
    Route::get('/charactersRuta', [CharacterController::class, 'mostrarCharacters'])->name('charactercontroller.mostrarCharacters');
    Route::get('/characters/{character}/editar', [CharacterController::class, 'edit'])->name('characters.edit');
    Route::get('/characters/{character}/editar', [CharacterController::class, 'edit'])->name('characters.edit');
    Route::put('/characters/{character}', [CharacterController::class, 'update'])->name('characters.update');
    Route::post('/characters/{character}', [CharacterController::class, 'update']);
    Route::delete('/characters/{character}', [CharacterController::class, 'destroy'])->name('characters.destroy');
    

    // Rutas de obras (Plays)
    Route::get('/plays', [PlayController::class, 'index'])->name('plays.index');
    Route::get('/plays/create', [PlayController::class, 'create'])->name('plays.create');
    Route::post('/plays', [PlayController::class, 'store'])->name('plays.store');
    Route::get('/plays/{play}/edit', [PlayController::class, 'edit'])->name('plays.edit');
    Route::put('/plays/{play}', [PlayController::class, 'update'])->name('plays.update');
    Route::delete('/plays/{play}', [PlayController::class, 'destroy'])->name('plays.destroy');
});

require __DIR__ . '/auth.php';
require __DIR__ . '/preview.php';