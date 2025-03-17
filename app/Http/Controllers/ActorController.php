<?php

namespace App\Http\Controllers;

use App\Models\Actor; // Asegúrate de tener este modelo creado
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\Redirect;

class ActorController extends Controller
{
    // Mostrar los actores (podrías usar esto para mostrar una lista)
    public function mostrarActores(Request $request): Response
    {
        $actores = Actor::all(); // Obtener los actores
        return Inertia::render('actores/Actores', [
            'actores' => $actores, // Pasarlos a la vista
            'status' => session('status'),
    ]);
    }

    
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
    $actores = Actor::all(); // Obtener todos los actores para la tabla
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Cambiado de 'foto' a 'image'
        ]);

        $actor = new Actor($request->only([
            'first_name', 'last_name', 'phone', 'email', 'city', 'has_car', 'can_drive', 'active',
        ]));

        if ($request->hasFile('image')) {
            $actor->image = $request->file('image')->store('actores', 'public');
        }

        $actor->save();//lo guarda en la base de datos

        // Redirigir a la ruta 'actores.index', que renderiza Actores.vue
        return redirect()->route('actores.index')->with('success', 'Actor creado correctamente.');
    }

    public function edit($id)
{
    $actor = Actor::findOrFail($id);
    $actores = Actor::all(); // Obtener todos los actores para la tabla
    return Inertia::render('actores/EditarActor', [
        'actor' => $actor,
        'actores' => $actores,
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

        $actor->update($request->only([
            'first_name', 'last_name', 'phone', 'email', 'city', 'has_car', 'can_drive', 'active',
        ]));

        if ($request->hasFile('image')) {
            $actor->image = $request->file('image')->store('actores', 'public');
            $actor->save();
        }

        return redirect()->route('actores.index')->with('success', 'Actor actualizado correctamente.');
    }


    public function destroy($id)
    {
        $actor = Actor::findOrFail($id);
        $actor->delete();

        return redirect()->route('actores.index')->with('success', 'Actor eliminado correctamente.');
    }


}
