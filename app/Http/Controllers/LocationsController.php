<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Event;
use Illuminate\Http\Request;

class LocationsController extends Controller
{
    public function index()
    {
        return inertia('locations/Index', [
            'events' => Event::with('location')->get(),
            'locations' => Location::all()
        ]);
    }

    public function create()
    {
        return inertia('locations/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'city' => 'required|string|max:100',
            'province' => 'required|string|max:100',
            'region' => 'required|string|max:100',
            'street_type' => 'required|string|max:50',
            'street_name' => 'required|string|max:100',
            'street_number' => 'required|string|max:20',
            'postal_code' => 'required|string|max:20',
        ]);

        Location::create($request->all());
        return redirect()->route('events.index');
    }

    public function edit(Location $location)
    {
        return inertia('Locations/Edit', [
            'location' => $location
        ]);
    }

    public function update(Request $request, Location $location)
    {
        $request->validate([
            'city' => 'required|string|max:100',
            'province' => 'required|string|max:100',
            'region' => 'required|string|max:100',
            'street_type' => 'required|string|max:50',
            'street_name' => 'required|string|max:100',
            'street_number' => 'required|string|max:20',
            'postal_code' => 'required|string|max:20',
        ]);

        $location->update($request->all());
        return redirect()->route('events.index');
    }

    public function destroy(Location $location)
    {
        $location->delete();
        return redirect()->route('events.index');
    }
}