@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Event Details</h4>
            </div>

            <div class="card-body">
                <p><strong>Title:</strong> {{ $event->title }}</p>
                <p><strong>Description:</strong> {{ $event->description }}</p>
                <p><strong>Start Date & Time:</strong> {{ \Carbon\Carbon::parse($event->start_datetime)->format('d M Y, H:i') }}</p>
                <p><strong>End Date & Time:</strong> {{ \Carbon\Carbon::parse($event->end_datetime)->format('d M Y, H:i') }}</p>
                <p><strong>Status:</strong> 
                    <span class="badge bg-{{ $event->status == 'active' ? 'success' : 'secondary' }}">
                        {{ ucfirst($event->status) }}
                    </span>
                </p>
                <p><strong>Organizer:</strong> {{ $event->organizer->name }} {{ $event->organizer->surname }}</p>
                <p><strong>Venue:</strong> {{ $event->venue->name }}</p>
                <hr>
                <h5>Attendees ({{ $event->attendees->count() }})</h5>
                @if($event->attendees->count())
                    <ul class="list-group">
                        @foreach($event->attendees as $user)
                            <li class="list-group-item">
                                {{ $user->name }} {{ $user->surname }}
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-muted">No attendees yet.</p>
                @endif
            </div>

            <div class="card-footer d-flex justify-content-between">
                <a href="{{ route('events.index') }}" class="btn btn-secondary">
                    ← Back to Events
                </a>

                <div>
                    <a href="{{ route('events.edit', $event->id) }}" class="btn btn-primary">Edit</a>

                    <form action="{{ route('events.cancelEvent', $event->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('PATCH')
                        <button class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this event?')">
                            Cancel
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection