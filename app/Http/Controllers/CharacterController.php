<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Character;
use App\Models\Play;
use Inertia\Inertia;
use Illuminate\Support\Facades\Log;

class CharacterController extends Controller
{
    public function index()
    {
        $characters = Character::all();
        return Inertia::render('personajes/CharacterList', [ // <-- Antes: 'CharacterList'
            'characters' => $characters,
        ]);
    }

    public function create()
    {
        $characters = Character::all();
        $plays = Play::all();
        return Inertia::render('personajes/CharacterForm', [ // <-- Antes: 'CharacterForm'
            'characters' => $characters,
            'plays'      => $plays,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'play_id'=> 'nullable|integer|exists:plays,id',
            'notes' => 'nullable|string|max:500',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $character = new Character();
        $character->name  = $request->name;
        $character->notes = $request->notes;
        $character->play_id = $request->play_id;

        if ($request->hasFile('image')) {
            try {
                $imagePath = $request->file('image')->store('characters', 'public');
                $character->image = $imagePath;
            } catch (\Exception $e) {
                Log::error('Error al subir la imagen:', ['error' => $e->getMessage()]);
                return response()->json(['error' => 'Error al subir la imagen'], 500);
            }
        }

        $character->save();
        return redirect()->route('characters.index');
    }

    public function mostrarCharacters()
    {
        $characters = Character::all();
        return Inertia::render('personajes/CharacterList', [
            'characters' => $characters,
        ]);
    }

    public function edit(Character $character)
    {
        $characters = Character::all();
        return Inertia::render('personajes/CharacterEdit', [
            'character'  => $character,
            'characters' => $characters,
        ]);
    }

    public function update(Request $request, Character $character)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'notes' => 'nullable|string|max:500',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $character->name  = $request->name;
        $character->notes = $request->notes;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('characters', 'public');
            $character->image = $imagePath;
        }

        $character->save();
        return redirect()->route('characters.index');
    }

    public function destroy(Character $character)
    {
        $character->delete();
        return redirect()->route('characters.index');
    }
}
