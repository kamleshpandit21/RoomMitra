@extends('layouts.admin')
@section('title', 'Room Details')

@push('styles')
    <style>
        .room-gallery img {
            width: 100%;
            border-radius: 8px;
            margin-bottom: 15px;
        }

        .gallery-col {
            width: 300px;
        }

        .status-badge {
            font-size: 0.85rem;
        }

        .amenity-item i {
            margin-right: 8px;
        }

        .rule-list li {
            margin-bottom: 6px;
        }
    </style>
@endpush

@section('content')
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card p-4">
        <h2 class="mb-3"><i class="fas fa-house-user"></i> Room Details</h2>

        <!-- Basic Details -->
        <div class="row mb-4">
            <div class="col-md-4"><strong>Title:</strong> {{ $room->room_title }}</div>
            <div class="col-md-2"><strong>No.:</strong> #{{ $room->room_number }}</div>
            <div class="col-md-2"><strong>Price:</strong> ₹{{ intval($room->room_price) }}</div>
            <div class="col-md-2"><strong>Capacity:</strong> {{ $room->room_capacity }} Persons</div>
            <div class="col-md-2"><strong>Type:</strong> PG</div>
        </div>

        <!-- Sharing Prices -->
        <h5><i class="fas fa-bed"></i> Sharing Prices</h5>
        <ul class="list-group list-group-flush mb-4">
            @foreach ($room->sharing_prices as $key => $price)
                <li class="list-group-item">{{ ucwords($key) }}: ₹{{ intval($price) }}</li>
            @endforeach
        </ul>

        <!-- Description & Rules -->
        <h5><i class="fas fa-clipboard-list"></i> Description & Rules</h5>
        <p>{{ $room->room_description }}</p>
        <ul class="rule-list">
            @foreach (explode("\n", $room->restrictions) as $rule)
                @if (trim($rule))
                    <li>{{ trim($rule) }}</li>
                @endif
            @endforeach
        </ul>

        <!-- Address & Map -->
        <h5><i class="fas fa-map-marker-alt"></i> Location</h5>
        <p>{{ ucwords($room->locality) }}, {{ $room->city }}, {{ $room->state }}</p>
        <p>{{ $room->address_line1 }}</p>
        <p>{{ $room->address_line2 }}</p>
        <div class="mb-4">
            <iframe
                src="https://maps.google.com/maps?q={{ urlencode($room->latitude ?? 'mumbai') }},{{ urlencode($room->longitude ?? '') }}&t=&z=13&ie=UTF8&iwloc=&output=embed"
                width="100%" height="250" frameborder="0" style="border:0; border-radius: 8px;" allowfullscreen>
            </iframe>
        </div>

        <!-- Image Gallery -->
        <h5><i class="fas fa-images"></i> Gallery</h5>
        <div class="d-flex flex-wrap gap-4 room-gallery">
            @forelse($room->images as $image)
                <div class="gallery-col">
                    <img src="{{ asset($image->image_url) }}" alt="Room Image">
                    <button class="btn btn-sm btn-danger w-100"><i class="fas fa-trash"></i> Delete</button>
                </div>
            @empty
                <p>No images uploaded.</p>
            @endforelse
        </div>

        <!-- Amenities -->
        <h5 class="mt-4"><i class="fas fa-concierge-bell"></i> Amenities</h5>
        <ul class="list-group list-group-flush">
            @forelse($room->amenities as $amenity)
                <li class="list-group-item amenity-item">
                    <i class="fas fa-check-circle"></i>
                    {{ $amenity->amenity_name }} -
                    <strong>
                        {{ ucfirst($amenity->status) }}
                        @if ($amenity->status == 'paid')
                            (₹{{ number_format($amenity->price) }}/month)
                        @endif
                    </strong>
                </li>
            @empty
                <li class="list-group-item">No amenities listed.</li>
            @endforelse
        </ul>

        <!-- Entry Exit -->
        <h5 class="mt-4"><i class="fas fa-clock"></i> Entry/Exit Time</h5>
        <p>
            Entry: {{ $room->entry_time ? $room->entry_time->format('g:i A') : 'N/A' }} |
            Exit: {{ $room->exit_time ? $room->exit_time->format('g:i A') : 'N/A' }}
        </p>

        <!-- Status -->
        <h5><i class="fas fa-info-circle"></i> Room Status</h5>
        <div class="mb-3">
            <span class="badge bg-{{ $room->is_verified ? 'success' : 'secondary' }} status-badge">
                {{ $room->is_verified ? 'Verified' : 'Not Verified' }}
            </span>
            <span class="badge bg-{{ $room->status === 'available' ? 'secondary' : 'warning' }} status-badge">
                {{ ucfirst($room->status) }}
            </span>
        </div>

        <div class=" gap-5 mb-4">
            <form method="POST" action="{{ route('admin.rooms.approve', $room->room_id) }}" style="display: inline;">
                @csrf
                @method('PATCH')
                <button type="submit" class="btn btn-outline-success">
                    <i class="fas fa-check"></i> Approve Room
                </button>
            </form>
        </div>

        <!-- Complaints -->
        <h5><i class="fas fa-exclamation-triangle"></i> Complaints</h5>
        <ul>
            <li>Noise complaint received on 12-Apr-2024</li>
            <li>Wi-Fi not working - Resolved</li>
        </ul>
    </div>
@endsection
