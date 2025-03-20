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
      $data = $request->validate([
          'first_name' => 'required|string|max:255',
          'last_name'  => 'required|string|max:255',
          'phone'      => 'nullable|string|max:20',
          'email'      => 'required|email',
          'city'       => 'nullable|string|max:255',
          'has_car'    => 'required|boolean',
          'can_drive'  => 'required|boolean',
          'active'     => 'required|boolean',
          'notes'      => 'nullable|string',
      ]);

      SupportStaff::create($data);

      return redirect()->route('staff.index')->with('success', 'Personal de soporte creado correctamente.');
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
      $data = $request->validate([
          'first_name' => 'required|string|max:255',
          'last_name'  => 'required|string|max:255',
          'phone'      => 'nullable|string|max:20',
          'email'      => 'required|email',
          'city'       => 'nullable|string|max:255',
          'has_car'    => 'required|boolean',
          'can_drive'  => 'required|boolean',
          'active'     => 'required|boolean',
          'notes'      => 'nullable|string',
      ]);

      $staff = SupportStaff::findOrFail($id);
      $staff->update($data);

      return redirect()->route('staff.index')->with('success', 'Personal de soporte actualizado correctamente.');
  }

  // Eliminar registro
  public function destroy($id)
  {
      $staff = SupportStaff::findOrFail($id);
      $staff->delete();

      return redirect()->route('staff.index')->with('success', 'Personal de soporte eliminado correctamente.');
  }
}
