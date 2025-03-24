<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SupportStaff;
use Inertia\Inertia;

class SupportStaffController extends Controller
{
    // Mostrar listado
    public function index()
    {
        $staff = SupportStaff::all();
        return Inertia::render('staff_soporte/Index', [
            'staff' => $staff
        ]);
    }

    // Mostrar formulario de creación
    public function create()
    {
        return Inertia::render('staff_soporte/Create');
    }

    // Guardar nuevo registro
    public function store(Request $request)
    {
        // Primero validamos
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'phone'      => 'nullable|string|max:20',
            'email'      => 'required|email',
            'city'       => 'nullable|string|max:255',
            'has_car'    => 'boolean',
            'can_drive'  => 'boolean',
            'active'     => 'boolean',
            'notes'      => 'nullable|string',
        ]);

        // Ahora creamos el modelo forzando booleans
        $staff = new SupportStaff();
        $staff->first_name = $request->input('first_name');
        $staff->last_name  = $request->input('last_name');
        $staff->email      = $request->input('email');
        $staff->phone      = $request->input('phone');
        $staff->city       = $request->input('city');
        $staff->has_car    = $request->boolean('has_car');
        $staff->can_drive  = $request->boolean('can_drive');
        $staff->active     = $request->boolean('active');
        $staff->notes      = $request->input('notes');

        $staff->save();

        return redirect()->route('staff.index')
                         ->with('success', 'Personal de soporte creado correctamente.');
    }

    // Mostrar formulario de edición
    public function edit($id)
    {
        $staff = SupportStaff::findOrFail($id);
        return Inertia::render('staff_soporte/Edit', [
            'staff' => $staff
        ]);
    }

    // Actualizar registro
    public function update(Request $request, $id)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'phone'      => 'nullable|string|max:20',
            'email'      => 'required|email',
            'city'       => 'nullable|string|max:255',
            'has_car'    => 'boolean',
            'can_drive'  => 'boolean',
            'active'     => 'boolean',
            'notes'      => 'nullable|string',
        ]);

        $staff = SupportStaff::findOrFail($id);
        $staff->first_name = $request->input('first_name');
        $staff->last_name  = $request->input('last_name');
        $staff->email      = $request->input('email');
        $staff->phone      = $request->input('phone');
        $staff->city       = $request->input('city');
        $staff->has_car    = $request->boolean('has_car');
        $staff->can_drive  = $request->boolean('can_drive');
        $staff->active     = $request->boolean('active');
        $staff->notes      = $request->input('notes');

        $staff->save();

        return redirect()->route('staff.index')
                         ->with('success', 'Personal de soporte actualizado correctamente.');
    }

    // Eliminar registro
    public function destroy($id)
    {
        $staff = SupportStaff::findOrFail($id);
        $staff->delete();

        return redirect()->route('staff.index')
                         ->with('success', 'Personal de soporte eliminado correctamente.');
    }
}
