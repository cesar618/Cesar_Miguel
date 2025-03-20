<?php

namespace App\Http\Controllers;

use App\Models\Play;
use App\Models\Producer;
use App\Models\Character;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Log;

class PlayController extends Controller
{
    /**
     * Muestra el listado de obras.
     */
    public function index()
    {
        $plays = Play::with('producer')->get(); // Esto carga la relación producer

        return Inertia::render('obras/Index', [
            'plays' => $plays,
        ]);
    }

    /**
     * Muestra el formulario para crear una nueva obra.
     */
    public function create()
    {
        $productoras = Producer::all();
        $characters = Character::all(); // Obtiene todos los personajes disponibles
        return Inertia::render('obras/Create', [
            'productoras' => $productoras,
            'characters' => $characters,
        ]);
    }

    /**
     * Guarda una nueva obra en la base de datos.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:50',
            'producer_id' => 'nullable|integer|exists:producers,id',
            'date'        => 'required|date',
            'active'      => 'required|boolean',
            'notes'       => 'nullable|string|max:255',
        ]);

        Play::create($validated);

        return redirect()->route('obras.index')
                         ->with('success', 'Obra creada correctamente.');
    }

    /**
     * Muestra el formulario para editar una obra existente.
     */
    public function edit($id)
    {
        $play = Play::with('producer')->findOrFail($id);
        $productoras = Producer::all();
        $characters = Character::all();

        return Inertia::render('obras/Edit', [
            'play' => $play,
            'productoras' => $productoras,
            'characters' => $characters,
        ]);
    }

    /**
     * Actualiza la obra en la base de datos.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:50',
            'producer_id' => 'nullable|integer|exists:producers,id',
            'date'        => 'required|date',  // Agrega esta validación
            'active'      => 'required|boolean',
            'notes'       => 'nullable|string|max:255',
        ]);
    
        $play = Play::findOrFail($id);
        $play->update($validated);
    
        return redirect()->route('obras.index')
                         ->with('success', 'Obra actualizada correctamente.');
    }

    /**
     * Elimina una obra de la base de datos.
     */
    public function destroy($id)
    {
        $play = Play::findOrFail($id);
        $play->delete();

        return redirect()->route('obras.index')
                         ->with('success', 'Obra eliminada correctamente.');
    }
}