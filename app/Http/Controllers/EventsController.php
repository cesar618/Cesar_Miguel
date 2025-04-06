<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Play;
use App\Models\Location;
use Illuminate\Http\Request;
use Inertia\Inertia;

class EventsController extends Controller
{
    public function index()
    {
        $events = Event::with(['play', 'location'])->get();
        return Inertia::render('eventos/Index', ['events' => $events]);
    }

    public function create()
    {
        $plays = Play::all();
        $locations = Location::all();
        return Inertia::render('eventos/Create', [
            'plays' => $plays,
            'locations' => $locations,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'play_id' => 'nullable|exists:plays,id',
            'date' => 'required|date',
            'start_time' => 'nullable',
            'end_time' => 'nullable|after:start_time',
            'description' => 'nullable|string|max:100',
            'url_info' => 'nullable|url|max:255',
            'url_tickets' => 'nullable|url|max:255',
            'location_id' => 'nullable|exists:locations,id',
        ]);

        Event::create($request->all());
        return redirect()->route('events.index');
    }

    public function edit(Event $event)
    {
        $plays = Play::all();
        $locations = Location::all();
        return Inertia::render('eventos/Edit', [
            'event' => $event,
            'plays' => $plays,
            'locations' => $locations,
        ]);
    }

    public function update(Request $request, Event $event)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'play_id' => 'nullable|exists:plays,id',
            'date' => 'required|date',
            'start_time' => 'nullable',
            'end_time' => 'nullable|after:start_time',
            'description' => 'nullable|string|max:100',
            'url_info' => 'nullable|url|max:255',
            'url_tickets' => 'nullable|url|max:255',
            'location_id' => 'nullable|exists:locations,id',
        ]);

        $event->update($request->all());
        return redirect()->route('events.index');
    }

    public function destroy(Event $event)
    {
        $event->delete(); // Soft delete
        return redirect()->route('events.index');
    }
}