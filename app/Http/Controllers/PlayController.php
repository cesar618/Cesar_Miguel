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
    public function index()
    {
        $plays = Play::with('producer', 'characters')->get();
        return Inertia::render('PlayList', [
            'plays' => $plays,
        ]);
    }

    public function create()
    {
        $producers = Producer::all();
        $characters = Character::all();
        return Inertia::render('PlayForm', [
            'producers'  => $producers,
            'characters' => $characters,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'date'        => 'required|date',
            'location'    => 'required|string|max:255',
            'producer_id' => 'required|exists:producers,id',
            'active'      => 'required|boolean',
            'notes'       => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validación para la imagen
        ]);

        $play = new Play();
        $play->name = $request->name;
        $play->date = $request->date;
        $play->location = $request->location;
        $play->producer_id = $request->producer_id;
        $play->active = $request->active;
        $play->notes = $request->notes;

        if ($request->hasFile('image')) {
            $play->image = $request->file('image')->store('plays', 'public');
            Log::info('Imagen guardada: ' . $play->image);
        } else {
            $play->image = null; // Explícitamente null si no hay imagen
            Log::info('No se subió imagen');
        }

        $play->save();

        return redirect()->route('plays.index')->with('success', 'Play created successfully.');
    }

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

    public function update(Request $request, Play $play)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'date'        => 'required|date',
            'location'    => 'required|string|max:255',
            'producer_id' => 'required|exists:producers,id',
            'active'      => 'required|boolean',
            'notes'       => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $play->name = $request->name;
        $play->date = $request->date;
        $play->location = $request->location;
        $play->producer_id = $request->producer_id;
        $play->active = $request->active;
        $play->notes = $request->notes;

        if ($request->hasFile('image')) {
            $play->image = $request->file('image')->store('plays', 'public');
            Log::info('Imagen actualizada: ' . $play->image);
        }

        $play->save();

        return redirect()->route('plays.index')->with('success', 'Play updated successfully.');
    }

    public function destroy(Play $play)
    {
        $play->delete();
        return redirect()->route('plays.index')->with('success', 'Play deleted successfully.');
    }
}