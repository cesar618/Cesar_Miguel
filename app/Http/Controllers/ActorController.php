<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ActorController extends Controller
{
    public function index()
    {
        $actores = Actor::all();
        return Inertia::render('actores/Actores', [
            'actores' => $actores,
            'success' => session('success'),
        ]);
    }

    public function create()
    {
        $actores = Actor::all();
        return Inertia::render('actores/CrearActor', [
            'actores' => $actores,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'phone' => 'nullable|string|max:15',
            'email' => 'nullable|email|max:30|unique:actors,email',
            'city' => 'nullable|string|max:30',
            'has_car' => 'nullable|boolean',
            'can_drive' => 'nullable|boolean',
            'active' => 'boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $actor = new Actor($request->only([
            'first_name', 'last_name', 'phone', 'email', 'city', 'has_car', 'can_drive', 'active',
        ]));

        if ($request->hasFile('image')) {
            $actor->image = $request->file('image')->store('actores', 'public');
        }

        $actor->save();

        return response()->json(['message' => 'Actor creado correctamente'], 201);
    }

    public function edit($id)
    {
        $actor = Actor::findOrFail($id);
        return Inertia::render('actores/EditarActor', [
            'actor' => $actor,
        ]);
    }

    public function update(Request $request, $id)
    {
        $actor = Actor::findOrFail($id);

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:15',
            'email' => 'nullable|email|max:255|unique:actors,email,' . $actor->id,
            'city' => 'nullable|string|max:255',
            'has_car' => 'boolean',
            'can_drive' => 'boolean',
            'active' => 'boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $actor->fill($request->only([
            'first_name', 'last_name', 'phone', 'email', 'city', 'has_car', 'can_drive', 'active',
        ]));

        if ($request->hasFile('image')) {
            $actor->image = $request->file('image')->store('actores', 'public');
        }

        $actor->save();

        // Redirigir a la ruta 'actores.index', que renderiza Actores.vue
        return redirect()->route('actores.index');
    }

    public function destroy($id)
    {
        $actor = Actor::findOrFail($id);
        $actor->delete();

        return response()->json(['message' => 'Actor eliminado correctamente'], 200);
    }

    public function mostrarActores(Request $request)
    {
        $actores = Actor::all();
        return Inertia::render('actores/Actores', [
            'actores' => $actores,
            'status' => session('status'),
        ]);
    }
}