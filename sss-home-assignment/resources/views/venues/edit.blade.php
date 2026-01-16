@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-warning">
            <h4 class="mb-0">Edit Venue</h4>
        </div>

        <div class="card-body">
            <form action="{{ route('venues.update', $venue->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">Venue Name</label>
                    <input
                        type="text"
                        class="form-control"
                        id="name"
                        name="name"
                        placeholder="Enter venue name"
                        value="{{ old('name', $venue->name) }}"
                        required
                    >
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <input
                        type="text"
                        class="form-control"
                        id="address"
                        name="address"
                        placeholder="Enter address"
                        value="{{ old('address', $venue->address) }}"
                        required
                    >
                </div>
                
                <div class="mb-3">
                    <label for="city" class="form-label">City</label>
                    <input
                        type="text"
                        class="form-control"
                        id="city"
                        name="city"
                        placeholder="Enter city"
                        value="{{ old('city', $venue->city) }}"
                        required
                    >
                </div>

                <div class="mb-3">
                    <label for="country" class="form-label">Country</label>
                    <input
                        type="text"
                        class="form-control"
                        id="country"
                        name="country"
                        placeholder="Enter country"
                        value="{{ old('country', $venue->country) }}"
                        required
                    >
                </div>

                <div class="mb-3">
                    <label for="capacity" class="form-label">Venue Capacity</label>
                    <input
                        type="number"
                        class="form-control"
                        id="capacity"
                        name="capacity"
                        placeholder="Enter venue capacity"
                        value="{{ old('capacity', $venue->capacity) }}"
                        min="1"
                    >
                </div>

                <button type="submit" class="btn btn-warning">Update Venue</button>
                <a href="{{ route('venues.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection