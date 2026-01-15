<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\User;
use App\Models\Venue;

class EventController extends Controller
{
    function index(){
        $events = Event::all();
        return view('events.index', compact('events'));
    }

    function show($id){
        $event = Event::find($id);
        return view('events.show', compact('event'));
    }

    function edit($id){
        $event = Event::find($id);
        $venues = Venue::all();
        return view('events.edit', compact('event', 'venues'));
    }

    function update($id, Request $request){
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'start_datetime' => 'required|date|after_or_equal:now',
            'end_datetime' => 'required|date|after:start_datetime',
        
            'organizer_name' => 'required|string|max:255',
            'organizer_surname' => 'required|string|max:255',
            'organizer_email' => 'required|email'
        ]);

        // Either retrieve the user from the database and update the name and surname, or create a new user.
        $organizer = User::updateOrCreate(
            ['email' => $request->organizer_email],
            [
                'name' => $request->organizer_name,
                'surname' => $request->organizer_surname,
                'role' => 'organizer'
            ]
        );

        $event = Event::find($id);
        $event->update([
            'title' => $request->title,
            'description' => $request->description,
            'start_datetime' => $request->start_datetime,
            'end_datetime' => $request->end_datetime,
            'status' => 'scheduled',
            'venue_id' => $request->venue_id,
            'organizer_id' => $organizer->id,
        ]);

        return redirect()->route('events.index')->with('success', 'Event updated successfully!');
    }

    function create(){
        $event = new Event();
        $venues = Venue::all();
        return view('events.create', compact('event', 'venues'));
    }

    public function createNewEvent(Request $request){
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'start_datetime' => 'required|date|after_or_equal:now',
            'end_datetime' => 'required|date|after:start_datetime',
        
            'organizer_name' => 'required|string|max:255',
            'organizer_surname' => 'required|string|max:255',
            'organizer_email' => 'required|email'
        ]);

        $organizer = User::firstOrCreate(
            ['email' => $request->organizer_email],
            [
                'name' => $request->organizer_name,
                'surname' => $request->organizer_surname,
                'role' => 'organizer'
            ]
        );

        Event::create([
            'title' => $request->title,
            'description' => $request->description,
            'start_datetime' => $request->start_datetime,
            'end_datetime' => $request->end_datetime,
            'status' => 'scheduled',
            'organizer_id' => $organizer->id,
            'venue_id' => $request->venue_id
        ]);

        return redirect()->route('events.index')->with('success', 'Event has been created successfully!');
    }
}
