<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venue;

class VenueController extends Controller
{
    function index() {
        $venues = Venue::all();
        return view('venues.index', compact('venues'));
    }

    function create(){
        $venues = new Venue();
        return view('venues.create', compact('venues'));
    }

    public function createNewVenue(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'capacity' => 'required|numeric|min:1'
        ]);

        Venue::create([
            'name' => $request->name,
            'address' => $request->address,
            'city' => $request->city,
            'country' => $request->country,
            'capacity' => $request->capacity
        ]);

        return redirect()->route('venues.index')->with('success', 'Venue has been created successfully!');
    }

    function show($id){
        $venue = Venue::find($id);
        return view('venues.show', compact('venue'));
    }

    function edit($id){
        $venue = Venue::find($id);
        return view('venues.edit', compact('venue'));
    }

    function update($id, Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'capacity' => 'required|numeric|min:1'
        ]);

        $venue = Venue::find($id);
        $venue->update($request->all());
        return redirect()->route('venues.index')->with('message', 'Venue has been updated successfully!');
    }

    function delete($id){
        $venue = Venue::find($id);
        $venue->delete();
        return redirect()->route('venues.index')->with('message', 'Venue has been deleted successfully!');
    }
}
