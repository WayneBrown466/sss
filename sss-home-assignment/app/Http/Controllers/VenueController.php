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

        $fullAddress = "$request->address $request->city $request->country";
        $apiKey = config('services.geocoding.key');
        // GET request to Google's geocoding API to check if the address inputted is a real street
        $response = Http::get('https://maps.googleapis.com/maps/api/geocode/json', [
            'address' => $fullAddress,
            'key' => $apiKey,
        ]);

        $data = $response->json();

        // If the API didn't return a 200 response return an error message
        if (
            $data['status'] !== 'OK' ||
            empty($data['results'])
        ) {
            return back()
                ->withErrors(['address' => 'The address could not be validated. Please enter a valid address.'])
                ->withInput();
        }

        // Checks if the geocoding result contains a real street by checking if the collection contains a 'route' type
        $hasRoute = collect($data['results'][0]['address_components'])
            ->pluck('types')
            ->flatten()
            ->contains('route');

        // If the address inputted is not a real street return an error message
        if (!$hasRoute) {
            return back()
                ->withErrors(['address' => 'Street name does not exist.'])
                ->withInput();
        }

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

        $fullAddress = "$venue->address $venue->city $venue->country";
        $apiKey = config('services.geocoding.key');
        // GET request to Google's geocoding API to retrieve the address coordinates
        $response = Http::get('https://maps.googleapis.com/maps/api/geocode/json', [
            'address' => $fullAddress,
            'key' => $apiKey
        ]);

        $data = $response->json();

        // Check if the API response data contains valid coordinates
        if (!empty($data['results'][0]['geometry']['location'])) {
            // Retrieve the latitude and longitude from the API response data
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

        $fullAddress = "$request->address $request->city $request->country";
        $apiKey = config('services.geocoding.key');
        // GET request to Google's geocoding API to check if the address inputted is a real street
        $response = Http::get('https://maps.googleapis.com/maps/api/geocode/json', [
            'address' => $fullAddress,
            'key' => $apiKey,
        ]);

        $data = $response->json();

        // If the API didn't return a 200 response return an error message
        if (
            $data['status'] !== 'OK' ||
            empty($data['results'])
        ) {
            return back()
                ->withErrors(['address' => 'The address could not be validated. Please enter a valid address.'])
                ->withInput();
        }

        // Checks if the geocoding result contains a real street by checking if the collection contains a 'route' type
        $hasRoute = collect($data['results'][0]['address_components'])
            ->pluck('types')
            ->flatten()
            ->contains('route');

        // If the address inputted is not a real street return an error message
        if (!$hasRoute) {
            return back()
                ->withErrors(['address' => 'Street name does not exist.'])
                ->withInput();
        }

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
