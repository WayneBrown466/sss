@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h2>Create New Venue</h2>

        <!-- Display validation errors -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('venues.createNewVenue') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Venue Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter venue name" required>
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" id="address" name="address" placeholder="Enter address" required>
            </div>

            <div class="mb-3">
                <label for="city" class="form-label">City</label>
                <input type="text" class="form-control" id="city" name="city" placeholder="Enter city" required>
            </div>

            <div class="mb-3">
                <label for="country" class="form-label">Country</label>
                <input type="text" class="form-control" id="country" name="country" placeholder="Enter country" required>
            </div>

            <div class="mb-3">
                <label for="capacity" class="form-label">Venue Capacity</label>
                <input type="number" class="form-control" id="capacity" name="capacity" placeholder="Enter capacity" required>
            </div>

            <button type="submit" class="btn btn-success">Create Venue</button>
            <a href="{{ route('venues.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection