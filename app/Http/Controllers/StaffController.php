<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Staff;
use Illuminate\Http\Request;
use Inertia\Inertia;

class StaffController extends Controller
{
    public function index($eventId)
    {
        $event = Event::findOrFail($eventId);
        $staffMembers = Staff::where('event_id', $eventId)->get();

        return Inertia::render('staff/SupportStaff', [
            'staffMembers' => $staffMembers,
            'eventId' => $eventId,
        ]);
    }

    public function create($eventId)
    {
        return Inertia::render('staff/StaffForm', [
            'eventId' => $eventId,
        ]);
    }

    public function store(Request $request, $eventId)
    {
        $request->validate([
            'role' => 'required|string|max:255',
            'level' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
        ]);

        Staff::create([
            'event_id' => $eventId,
            'role' => $request->role,
            'level' => $request->level,
            'name' => $request->name,
            'phone' => $request->phone,
        ]);

        return redirect()->route('staff.index', $eventId);
    }

    public function edit($eventId, $staffId)
    {
        $staff = Staff::findOrFail($staffId);
        return Inertia::render('staff/StaffForm', [
            'eventId' => $eventId,
            'staff' => $staff,
        ]);
    }

    public function update(Request $request, $eventId, $staffId)
    {
        $request->validate([
            'role' => 'required|string|max:255',
            'level' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
        ]);

        $staff = Staff::findOrFail($staffId);
        $staff->update($request->only(['role', 'level', 'name', 'phone']));

        return redirect()->route('staff.index', $eventId);
    }

    public function destroy($eventId, $staffId)
    {
        $staff = Staff::findOrFail($staffId);
        $staff->delete();

        return redirect()->route('staff.index', $eventId);
    }
}