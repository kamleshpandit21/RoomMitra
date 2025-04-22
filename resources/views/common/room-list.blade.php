@extends('layouts.app')

@push('styles')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
        .room-card {
            border: none;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            transition: transform 0.2s;
        }

        .room-card:hover {
            transform: translateY(-4px);
        }

        .room-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .badge-verified {
            background-color: #28a745;
        }

        .amenity-icon {
            margin-right: 0.5rem;
            font-size: 14px;
        }

        .like-btn {
            transition: color 0.3s;
        }

        .like-btn:hover {
            color: red;
        }
    </style>
@endpush

@section('content')
    <div class="container my-5">

        <h3 class="mb-4">🏘️ Available Rooms</h3>

        <div class="row g-4">
            @forelse ($rooms as $room)
                <div class="col-md-6 col-lg-4">
                    <div class="card room-card">
                        <img src="{{ $room->images->first()->image_url ?? asset('default-room.jpg') }}" class="card-img-top"
                            alt="Room Image">
                        <div class="card-body">
                            <h5 class="card-title">🏷 {{ $room->room_title }}</h5>

                            <p class="card-text text-muted mb-1">
                                <i class="fas fa-map-marker-alt me-1"></i>
                                {{ ucwords($room->locality) }}, {{ ucwords($room->city) }}, {{ ucwords($room->state) }}
                            </p>

                            <p class="card-text mb-1">
                                <i class="fas fa-rupee-sign me-1"></i> {{ intval($room->room_price) }} / month
                            </p>

                            <p class="card-text mb-2">
                                <i class="fas fa-user me-1"></i>
                                {{ $room->room_capacity === 1 ? '1 Person' : $room->room_capacity . ' Sharing' }} |
                                {{ ucwords($room->bathroom_type) }} Bathroom
                            </p>

                            <div class="d-flex flex-wrap gap-2 mb-3">
                                @php
                                    $icons = [
                                        'WiFi' => 'fa-wifi',
                                        'wifi' => 'fa-wifi',
                                        'Laundry' => 'fa-tshirt',
                                        'laundry' => 'fa-tshirt',
                                        'RO Water' => 'fa-tint',
                                        'ro' => 'fa-tint',
                                        'Fridge' => 'fa-snowflake',
                                        'TV' => 'fa-tv',
                                        'tv' => 'fa-tv',
                                        'Microwave' => 'fa-mitten',
                                    ];
                                @endphp

                                @foreach ($room->amenities as $amenity)
                                    <span class="text-muted small" title="{{ $amenity->amenity_name }}">
                                        <i
                                            class="fas {{ $icons[$amenity->amenity_name] ?? 'fa-concierge-bell' }} amenity-icon"></i>
                                        {{ $amenity->amenity_name }}
                                    </span>
                                @endforeach
                            </div>

                            <div class="d-flex justify-content-between align-items-center">
                                <span class="badge bg-{{ $room->is_verified ? 'success' : 'secondary' }}">
                                    {{ $room->is_verified ? 'Verified' : 'Not Verified' }}
                                </span>

                                <small class="text-muted" title="{{ $room->created_at->format('d M Y, h:i A') }}">
                                    📅 {{ $room->created_at->diffForHumans() }}
                                </small>
                            </div>

                            <hr>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('room.show', ['id' => $room->room_id]) }}"
                                    class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-eye me-1"></i> View Details
                                </a>
                                <button class="btn btn-sm btn-outline-danger like-btn">
                                    <i class="far fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-warning text-center">
                        <strong>No rooms found.</strong>
                    </div>
                </div>
            @endforelse
        </div>

        <div class="mt-4 d-flex justify-content-center">
            {{ $rooms->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
