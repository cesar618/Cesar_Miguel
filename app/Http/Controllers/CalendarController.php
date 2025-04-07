<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CalendarController extends Controller
{
    // Mostrar la vista del calendario
    public function index()
    {
        return Inertia::render('calendar/CalendarView');
    }

    // Obtener todos los eventos para FullCalendar
    public function events(Request $request)
    {
        $events = Event::with(['play', 'location'])->get()->map(function ($event) {
            // Combinar date y start_time/end_time para FullCalendar
            $start = $event->date . 'T' . $event->start_time;
            $end = $event->end_time ? $event->date . 'T' . $event->end_time : null;

            return [
                'id' => $event->id,
                'title' => $event->name,
                'start' => $start,
                'end' => $end,
                'allDay' => !$event->start_time, // Si no hay start_time, es todo el día
                'extendedProps' => [
                    'description' => $event->description,
                    'play' => $event->play->name ?? null,
                    'location' => $event->location->name ?? null,
                    'url_info' => $event->url_info,
                    'url_tickets' => $event->url_tickets,
                ],
            ];
        });

        return response()->json($events);
    }

    // Crear un nuevo evento
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'date' => 'required|date',
            'start_time' => 'nullable|date_format:H:i',
            'end_time' => 'nullable|date_format:H:i|after:start_time',
            'description' => 'nullable|string',
            'play_id' => 'nullable|exists:plays,id',
            'location_id' => 'nullable|exists:locations,id',
            'url_info' => 'nullable|url',
            'url_tickets' => 'nullable|url',
        ]);

        $event = Event::create($request->all());

        return response()->json(['message' => 'Event created', 'event' => $event], 201);
    }

    // Actualizar un evento (arrastrar y soltar)
    public function update(Request $request, Event $event)
    {
        $request->validate([
            'date' => 'required|date',
            'start_time' => 'nullable|date_format:H:i',
            'end_time' => 'nullable|date_format:H:i|after:start_time',
        ]);

        $event->update([
            'date' => $request->date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);

        return response()->json(['message' => 'Event updated']);
    }
}