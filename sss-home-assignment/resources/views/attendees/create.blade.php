@extends('layouts.app')

@section('content')
    <div class="container mt-4">

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('attendees.createNewAttendee', $eventId) }}" method="POST">
            @csrf

            <div class="card mb-4">
                <div class="card-header fw-bold">New Attendee</div>
                <div class="card-body">
                    
                    <div class="mb-3">
                        <label class="form-label">First Name</label>
                        <input 
                            type="text" 
                            id="name"
                            name="name"
                            class="form-control"
                            placeholder="Enter first name"
                            required
                        >
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Last Name</label>
                        <input 
                            type="text" 
                            id="surname"
                            name="surname" 
                            class="form-control"
                            placeholder="Enter last name" 
                            required
                        >
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input 
                            type="email" 
                            id="email"
                            name="email" 
                            class="form-control"
                            placeholder="Enter email" 
                            required
                        >
                    </div>

                    <button type="submit" class="btn btn-primary">Add Attendee</button>
                    <a href="{{ route('events.edit', $eventId) }}" class="btn btn-secondary">Cancel</a>
                </div>
            </div>
        </form>
    </div>
@endsection