@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">Edit Event</h3>

    <form action="{{ route('events.update', $event->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="card mb-4">
            <div class="card-header fw-bold">Event Details</div>
            <div class="card-body">

                <div class="mb-3">
                    <label class="form-label">Title</label>
                    <input 
                        type="text"
                        id="title"
                        name="title"
                        class="form-control"
                        placeholder="Enter event title"
                        value="{{ old('title', $event->title) }}"
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
                    >{{ old('description', $event->description) }}</textarea>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Start Date & Time</label>
                        <input 
                            type="datetime-local"
                            id="start_datetime"
                            name="start_datetime"
                            class="form-control"
                            value="{{ old('start_datetime', \Carbon\Carbon::parse($event->start_datetime)->format('Y-m-d\TH:i')) }}"
                            required
                        >
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">End Date & Time</label>
                        <input 
                            type="datetime-local"
                            id="end_datetime"
                            name="end_datetime"
                            class="form-control"
                            value="{{ old('end_datetime', \Carbon\Carbon::parse($event->end_datetime)->format('Y-m-d\TH:i')) }}"
                            required
                        >
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Venue</label>
                    <select id="venue_id" name="venue_id" class="form-select" required>
                        @foreach($venues as $venue)
                            <option value="{{ $venue->id }}"
                                {{ old('venue_id', $event->venue_id) == $venue->id ? 'selected' : '' }}>
                                {{ $venue->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header fw-bold">Organizer Details</div>
            <div class="card-body">

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">First Name</label>
                        <input 
                            type="text"
                            id="organizer_name"
                            name="organizer_name"
                            class="form-control"
                            placeholder="Enter organizer name"
                            value="{{ old('organizer_name', $event->organizer->name ?? '') }}"
                            required
                        >
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Surname</label>
                        <input 
                            type="text"
                            id="organizer_surname"
                            name="organizer_surname"
                            class="form-control"
                            placeholder="Enter organizer surname"
                            value="{{ old('organizer_surname', $event->organizer->surname ?? '') }}"
                            required
                        >
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Email</label>
                        <input 
                            type="email"
                            id="organizer_email"
                            name="organizer_email"
                            class="form-control"
                            placeholder="Enter organizer email"
                            value="{{ old('organizer_email', $event->organizer->email ?? '') }}"
                            required
                        >
                    </div>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('attendees.create', $event->id) }}" class="btn btn-success">New Attendee</a>
        <a href="{{ route('events.index') }}" class="btn btn-secondary">Cancel</a>
    </form>

    <div class="card mb-4">
        <div class="card-header fw-bold">Attendees</div>
        <div class="card-body">
            @if($event->attendees->count())
                <ul>
                    @foreach($event->attendees as $user)
                        <li class="mb-2">
                            <div class="row align-items-center">
                                <div class="col-1" style="min-width:170px">
                                    {{ $user->name }} {{ $user->surname }}
                                </div>

                                <div class="col p-0">
                                    <form action="{{ route('events.attendees.delete', [$event->id, $user->id]) }}"
                                        method="POST"
                                        class="mb-0"
                                        onsubmit="return confirm('Remove this attendee?')"
                                    >
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-muted">No attendees yet.</p>
            @endif
        </div>
    </div>

</div>
@endsection