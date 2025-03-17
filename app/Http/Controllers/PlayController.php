<?php

namespace App\Http\Controllers;

use App\Models\Play;
use App\Models\Producer;
use App\Models\Character;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PlayController extends Controller
{
    /**
     * Muestra la lista de obras existentes.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        // Obtener todas las obras activas con su productor y personajes asociados
        $plays = Play::with('producer', 'characters')->get();

        return Inertia::render('PlayList', [
            'plays' => $plays,
        ]);
    }

    /**
     * Muestra el formulario para crear una nueva obra.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        // Obtener los productores y personajes disponibles
        $producers = Producer::all();
        $characters = Character::all();

        return Inertia::render('PlayForm', [
            'producers'  => $producers,
            'characters' => $characters,
        ]);
    }

    /**
     * Almacena una nueva obra en la base de datos.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'date'        => 'required|date',
            'location'    => 'required|string|max:255',
            'producer_id' => 'required|exists:producers,id',
            'active'      => 'required|boolean',
            'notes'       => 'nullable|string',
            // Si deseas agregar validación para imagen u otros campos, agrégala aquí
        ]);

        // Crear la obra
        Play::create([
            'name'        => $request->name,
            'date'        => $request->date,
            'location'    => $request->location,
            'producer_id' => $request->producer_id,
            'active'      => $request->active,
            'notes'       => $request->notes,
        ]);

        return redirect()->route('plays.index')->with('success', 'Play created successfully.');
    }

    /**
     * Muestra el formulario para editar una obra.
     *
     * @param \App\Models\Play $play
     * @return \Inertia\Response
     */
    public function edit(Play $play)
    {
        $producers = Producer::all();
        $characters = Character::all();

        return Inertia::render('PlayForm', [
            'play'       => $play,
            'producers'  => $producers,
            'characters' => $characters,
        ]);
    }

    /**
     * Actualiza una obra existente.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Play $play
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Play $play)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'date'        => 'required|date',
            'location'    => 'required|string|max:255',
            'producer_id' => 'required|exists:producers,id',
            'active'      => 'required|boolean',
            'notes'       => 'nullable|string',
        ]);

        // Actualizar la obra
        $play->update([
            'name'        => $request->name,
            'date'        => $request->date,
            'location'    => $request->location,
            'producer_id' => $request->producer_id,
            'active'      => $request->active,
            'notes'       => $request->notes,
        ]);

        return redirect()->route('plays.index')->with('success', 'Play updated successfully.');
    }

    /**
     * Elimina una obra.
     *
     * @param \App\Models\Play $play
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Play $play)
    {
        $play->delete();
        return redirect()->route('plays.index')->with('success', 'Play deleted successfully.');
    }
}
