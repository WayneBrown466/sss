<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendee;
use App\Models\User;

class AttendeeController extends Controller
{
    function delete($eventId, $userId){
        $attendee = Attendee::where('user_id', $userId)
                            ->where('event_id', $eventId)
                            ->delete();
        
        return redirect()->route('events.edit', $eventId)->with('success', 'Attendee has been deleted successfully!');
    }

    function create($eventId){
        $attendee = new Attendee();
        return view('attendees.create', compact('attendee', 'eventId'));
    }

    public function createNewAttendee(Request $request, $eventId){
        $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|email'
        ]);

        $user = User::firstOrCreate(
            ['email' => $request->email],
            [
                'name' => $request->name,
                'surname' => $request->surname,
                'role' => 'attendee'
            ]
        );

        Attendee::firstOrCreate([
            'event_id' => $eventId,
            'user_id' => $user->id
        ]);

        return back()->with('success', 'Attendee added successfully!');
    }
}
