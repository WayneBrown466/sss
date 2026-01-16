@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" crossorigin=""/>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" crossorigin=""></script>
<div class="container mt-4">
    <div id="map" style="height: 300px;"></div>

    <script>
        // Centers the map on the marker location
        const map = L.map('map').setView([{{ $latitude }}, {{ $longitude }}], 15);

        // Adds the tile layer
        L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        // Adds the marker
        const marker = L.marker([{{ $latitude }}, {{ $longitude }}]).addTo(map);
        // When the marker is clicked show the venue information
        marker.bindPopup("<b>{{ $venue->name }}</b><br>{{ $venue->address . ' ' . $venue->city }}");
    </script>

    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Venue Details</h4>
        </div>

        <div class="card-body">
            <p><strong>Name:</strong> {{ $venue->name }}</p>
            <p><strong>Address:</strong> {{ $venue->address }}</p>
            <p><strong>City:</strong> {{ $venue->city }}</p>
            <p><strong>Country:</strong> {{ $venue->country }}</p>
            <p><strong>Capacity:</strong> {{ $venue->capacity }}</p>
        </div>

        <div class="card-footer d-flex justify-content-between">
            <a href="{{ route('venues.index') }}" class="btn btn-secondary">
                ← Back to Venues
            </a>

            <div>
                <a href="{{ route('venues.edit', $venue->id) }}" class="btn btn-primary">Edit</a>
                <form action="{{ route('venues.delete', $venue->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button 
                        type="submit" 
                        class="btn btn-danger"
                        onclick="return confirm('Are you sure you want to delete this venue?')"
                    >
                        Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection