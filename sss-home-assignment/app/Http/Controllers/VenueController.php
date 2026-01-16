<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venue;
use Illuminate\Support\Facades\Http;

class VenueController extends Controller
{
    function index() {
        $venues = Venue::all();
        return view('venues.index', compact('venues'));
    }

    function create(){
        $venue = new Venue();
        return view('venues.create', compact('venue'));
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

        $fullAddress = "$venue->address $venue->city";
        $apiKey = config('services.geocoding.key');
        $response = Http::get('https://maps.googleapis.com/maps/api/geocode/json', [
            'address' => $fullAddress,
            'key' => $apiKey
        ]);

        $data = $response->json();

        if (!empty($data['results'][0]['geometry']['location'])) {
            $latitude = $data['results'][0]['geometry']['location']['lat'];
            $longitude = $data['results'][0]['geometry']['location']['lng'];
        } else {
            $latitude = null;
            $longitude = null;
        }
        
        return view('venues.show', compact('venue', 'longitude', 'latitude'));
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
        return redirect()->route('venues.index')->with('success', 'Venue has been updated successfully!');
    }

    function delete($id){
        $venue = Venue::find($id);
        $venue->delete();
        return redirect()->route('venues.index')->with('success', 'Venue has been deleted successfully!');
    }
}
