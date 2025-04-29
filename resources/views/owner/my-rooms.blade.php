@extends('layouts.owner')
@section('title', 'My Rooms')

@section('content')

    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0">🏨 My Rooms</h3>
        <a href="{{ route('owner.rooms.create') }}" class="btn btn-primary">+ Add New Room</a>
    </div>
    <!-- Filter Form Start -->
    <form method="GET" action="{{ route('owner.rooms.index') }}">
        <div class="row g-2 mb-3">
            <div class="col-md-4">
                <input type="text" class="form-control" placeholder="🔍 Search by room title" name="search"
                    value="{{ request('search') }}" />
            </div>
            <div class="col-md-3">
                <select class="form-select form-control" name="type">
                    <option value="">All Types</option>
                    <option value="Single" {{ request('type') == 'Single' ? 'selected' : '' }}>Single</option>
                    <option value="Double" {{ request('type') == 'Double' ? 'selected' : '' }}>Double</option>
                    <option value="Triple" {{ request('type') == 'Triple' ? 'selected' : '' }}>Triple</option>
                </select>
            </div>
            <div class="col-md-3">
                <select class="form-select form-control" name="status">
                    <option value="">All Status</option>
                    <option value="Available" {{ request('status') == 'Available' ? 'selected' : '' }}>Available</option>
                    <option value="Booked" {{ request('status') == 'Booked' ? 'selected' : '' }}>Booked</option>
                    <option value="Inactive" {{ request('status') == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
            <div class="col-md-2">
                <button class="btn btn-outline-secondary w-100">Filter</button>
            </div>
        </div>
    </form>
    <!-- Filter Form End -->

    <!-- Table of Rooms -->
    <div class="table-responsive">
        <table class="table table-striped align-middle text-center">
            <thead class="table-light">
                <tr>
                    <th>Room No.</th>
                    <th>Image</th>
                    <th>Room Title</th>
                    <th>Type</th>
                    <th>Price (Per Month)</th>
                    <th>Status</th>
                    <th>Bookings</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>

                <!-- Loop Start -->
                @forelse($rooms as $room)
                    <tr>
                        <td>{{ $room->room_number }}</td>
                        <td>
                            @if ($room->images->isNotEmpty())
                                <img src="{{ asset($room->images->first()->image_url) }}" alt="Room Image" width="150"
                                    height="100" style="object-fit: cover; border-radius: 5px;">
                            @else
                                <p class="text-muted">No image available.</p>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('owner.rooms.show', $room->room_id) }}">{{ $room->room_title }}</a>
                        </td>
                        <td>{{ $room->type }}</td>
                        <td>₹{{ number_format($room->room_price) }}</td>
                        <td>
                            <span
                                class="badge bg-{{ $room->status == 'Available' ? 'success' : ($room->status == 'Booked' ? 'warning' : 'secondary') }}">
                                {{ $room->status }}
                            </span>
                        </td>
                        <td>{{ $room->bookings_count ?? 0 }}</td>
                        <td class="d-flex justify-content-center gap-2 flex-wrap">
                            <a href="{{ route('owner.rooms.edit', $room->room_id) }}"
                                class="btn btn-sm btn-outline-primary">✏️</a>
                            <form action="{{ route('owner.rooms.destroy', $room->room_id) }}" method="POST"
                                onsubmit="return confirm('Delete this room?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">🗑️</button>
                            </form>
                            <a href="{{ route('owner.rooms.show', $room->room_id) }}"
                                class="btn btn-sm btn-outline-info">👁️</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted">No rooms found.</td>
                    </tr>
                @endforelse
                <!-- Loop End -->
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-3">
        {{ $rooms->links('pagination::bootstrap-5') }}
    </div>




@endsection
