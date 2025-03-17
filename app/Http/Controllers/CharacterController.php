<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Character;
use Inertia\Inertia;
use Illuminate\Support\Facades\Log;

class CharacterController extends Controller
{
    public function index()
{
    $characters = Character::all();
    return Inertia::render('CharacterList', [
        'characters' => $characters,
    ]);
}

    public function create()
    {
        $characters = Character::all();
        return Inertia::render('CharacterForm', [
            'characters' => $characters,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'notes' => 'nullable|string|max:500',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $character = new Character();
        $character->name  = $request->name;
        $character->notes = $request->notes;

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
        return Inertia::render('views/CharacterList', [
            'characters' => $characters,
        ]);
    }

    public function edit(Character $character)
{
    $characters = Character::all();
    return Inertia::render('CharacterForm', [
        'character' => $character,
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