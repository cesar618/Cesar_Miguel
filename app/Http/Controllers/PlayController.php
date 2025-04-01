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
        $plays = Play::with(['producer', 'characters'])->get();

        return Inertia::render('obras/Index', [
            'plays' => $plays,
        ]);
    }

    public function removeCharacter($playId, $characterId)
        {
            $play = \App\Models\Play::findOrFail($playId);
            $play->characters()->detach($characterId);
            return response()->json(['message' => 'El personaje fue removido de la obra.']);
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
            'active'      => 'required|boolean',
            'notes'       => 'nullable|string|max:255',
            'character_ids'   => 'nullable|array',
            'character_ids.*' => 'integer|exists:characters,id',
        ]);

        // Crear la obra
        $play = Play::create($validated);

        // Asignar los personajes (si se seleccionaron)
        if (isset($validated['character_ids'])) {
            $play->characters()->attach($validated['character_ids']);
        }

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
            'active'      => 'required|boolean',
            'notes'       => 'nullable|string|max:255',
            'character_ids'   => 'nullable|array',
            'character_ids.*' => 'integer|exists:characters,id',
        ]);
    
        $play = Play::findOrFail($id);
        $play->update($validated);
    
        // Sincroniza los personajes seleccionados
        $play->characters()->sync($validated['character_ids'] ?? []);
    
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