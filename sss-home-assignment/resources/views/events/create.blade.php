@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Create New Event</h2>

        <form action="{{ route('events.createNewEvent') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Title</label>
                <input 
                    type="text" 
                    id="title"
                    name="title" 
                    class="form-control"
                    placeholder="Enter event title"
                    required
                >
            </div>

            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea 
                    id="description"
                    name="description" 
                    class="form-control"
                    rows="4"
                    placeholder="Enter event description"
                    required
                ></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Start Date & Time</label>
                <input 
                    type="datetime-local" 
                    id="start_datetime"
                    name="start_datetime" 
                    class="form-control" 
                    required
                >
            </div>

            <div class="mb-3">
                <label class="form-label">End Date & Time</label>
                <input 
                    type="datetime-local" 
                    id="end_datetime"
                    name="end_datetime" 
                    class="form-control" 
                    required
                >
            </div>

            <div class="mb-3">
                <label class="form-label">Venue</label>
                <select id="venue_id" name="venue_id" class="form-select" required>
                    <option value="" disabled selected>Select Venue</option>
                    @foreach ($venues as $venue)
                        <option value="{{ $venue->id }}">{{ $venue->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Organizer First Name</label>
                <input 
                    type="text"
                    id="organizer_name"
                    name="organizer_name"
                    class="form-control"
                    placeholder="Enter organizer first name"
                    required
                >
            </div>

            <div class="mb-3">
                <label class="form-label">Organizer Surname</label>
                <input 
                    type="text"
                    id="organizer_surname"
                    name="organizer_surname"
                    class="form-control"
                    placeholder="Enter organizer surname"
                    required
                >
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input 
                    type="email"
                    id="organizer_email"
                    name="organizer_email"
                    class="form-control"
                    placeholder="Enter organizer email"
                    required
                >
            </div>

            <button type="submit" class="btn btn-primary">Create Event</button>
            <a href="{{ route('events.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection