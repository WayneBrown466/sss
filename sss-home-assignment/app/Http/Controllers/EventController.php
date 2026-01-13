<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    function index(){
        $events = Event::all();
        return view('events.index', compact('events'));
    }
}
