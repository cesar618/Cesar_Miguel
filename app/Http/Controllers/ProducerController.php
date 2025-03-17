<?php

namespace App\Http\Controllers;

use App\Models\Producer;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;

class ProducerController extends Controller
{
    public function index()
    {
        $productoras = Producer::all();
        return Inertia::render('productoras/Productoras', [
            'productoras' => $productoras,
        ]);
    }

    public function create()
    {
        return Inertia::render('productoras/CrearProductora');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'cif' => 'required|string|max:20|unique:producers,cif',
            'image' => 'nullable|image|max:2048', // Máximo 2MB
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('producers', 'public');
            $validated['image'] = $path;
        }

        Producer::create($validated);

        return redirect()->route('productoras.index')->with('success', 'Productora creada con éxito.');
    }

    public function edit($id)
    {
        $productora = Producer::findOrFail($id);
        return Inertia::render('productoras/EditarProductora', [
            'productora' => $productora,
        ]);
    }

    public function update(Request $request, $id)
    {
        $productora = Producer::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'cif' => 'required|string|max:20|unique:producers,cif,' . $productora->id,
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Eliminar imagen anterior si existe
            if ($productora->image) {
                Storage::disk('public')->delete($productora->image);
            }
            $path = $request->file('image')->store('producers', 'public');
            $validated['image'] = $path;
        } else {
            $validated['image'] = $productora->image; // Mantener la imagen actual si no se sube una nueva
        }

        $productora->update($validated);

        return redirect()->route('productoras.index')->with('success', 'Productora actualizada con éxito.');
    }

    public function destroy($id)
    {
        $productora = Producer::findOrFail($id);
        if ($productora->image) {
            Storage::disk('public')->delete($productora->image);
        }
        $productora->delete();

        return redirect()->route('productoras.index')->with('success', 'Productora eliminada con éxito.');
    }
}
