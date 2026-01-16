@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>All Events</h2>
            <div class="d-flex gap-2">
                <input type="checkbox" id="showActiveOnly" {{ request('active_only') ? 'checked' : '' }}>
                <label for="showActiveOnly">Show only scheduled events</label>
            </div>
            <a href="{{ route('events.create') }}" class="btn btn-success">+ Create New Event</a>
        </div>

        @if($events->count())
        <table class="table table-bordered table-striped">
            <thead class="table-light">
                <tr>
                    <th>Title</th>
                    <th>Start Date & Time</th>
                    <th>End Date & Time</th>
                    <th>Status</th>
                    <th>Venue</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($events as $event)
                    <tr>
                        <td>{{ $event->title }}</td>
                        <td>{{ \Carbon\Carbon::parse($event->start_datetime)->format('d M Y, H:i') }}</td>
                        <td>{{ \Carbon\Carbon::parse($event->end_datetime)->format('d M Y, H:i') }}</td>
                        <td>{{ ucfirst($event->status) }}</td>
                        <td>{{ optional($event->venue)->name }}</td>
                        <td>
                            <a href="{{ route('events.show', $event->id) }}" class="btn btn-sm btn-info">View</a>
                            <a href="{{ route('events.edit', $event->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('events.cancelEvent', $event->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PATCH')
                                <button 
                                    type="submit" 
                                    class="btn btn-sm btn-danger"
                                    onclick="return confirm('Are you sure you want to cancel this event?')"
                                >
                                    Cancel
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @else
            <p class="text-muted">No events found.</p>
        @endif
    </div>

    <!-- Called when the "Show only active events" checkbox is changed.
        Updates the URL query parameter 'active_only' to filter events. -->
    <script>
        document.getElementById('showActiveOnly').addEventListener('change', function() {
            const url = new URL(window.location.href);
            if(this.checked) {
                url.searchParams.set('active_only', '1');
            } else {
                url.searchParams.delete('active_only');
            }
            window.location.href = url.toString();
        });
    </script>
@endsection