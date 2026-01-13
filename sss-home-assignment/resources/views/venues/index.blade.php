@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>All Venues</h2>
            <a href="{{ route('venues.create') }}" class="btn btn-success">+ Create New Venue</a>
        </div>

        @if($venues->count())
        <table class="table table-bordered table-striped">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Venue Name</th>
                    <th>City</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($venues as $venue)
                    <tr>
                        <td>{{ $venue->id }}</td>
                        <td>{{ $venue->name }}</td>
                        <td>{{ $venue->city }}</td>
                        <td>
                            <a href="{{ route('venues.show', $venue->id) }}" class="btn btn-sm btn-info">View</a>
                            <a href="{{ route('venues.edit', $venue->id) }}" class="btn btn-sm btn-primary">Edit</a>
                            <form action="{{ route('venues.delete', $venue->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button 
                                    type="submit" 
                                    class="btn btn-sm btn-danger" 
                                    onclick="return confirm('Are you sure you want to delete this venue?')"
                                >
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @else
            <p class="text-muted">No venues found.</p>
        @endif
    </div>
@endsection