@extends('layouts.app')

@section('title', 'Room List')

@push('styles')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/landing-page.css') }}">
@endpush

@section('content')
    <div class="container my-5 room-list-container" style="padding-top: 100px">

        <h1 class="display-5 fw-bold mb-3 heading">Available Rooms</h1>

        <div class="row g-4">
            <form method="GET" class="mb-4">
                <div class="row g-3">
                    <div class="col-md-3">
                        <input type="text" name="city" class="form-control" placeholder="Enter City" value="{{ request('city') }}">
                    </div>
            
                    <div class="col-md-2">
                        <input type="number" name="min_price" class="form-control" placeholder="Min Price" value="{{ request('min_price') }}">
                    </div>
            
                    <div class="col-md-2">
                        <input type="number" name="max_price" class="form-control" placeholder="Max Price" value="{{ request('max_price') }}">
                    </div>
            
                    <div class="col-md-2">
                        <select name="capacity" class="form-select">
                            <option value="">Sharing Type</option>
                            <option value="1" {{ request('capacity') == 1 ? 'selected' : '' }}>Single</option>
                            <option value="2" {{ request('capacity') == 2 ? 'selected' : '' }}>2 Sharing</option>
                            <option value="3" {{ request('capacity') == 3 ? 'selected' : '' }}>3 Sharing</option>
                            <option value="4" {{ request('capacity') == 4 ? 'selected' : '' }}>4 Sharing</option>
                        </select>
                    </div>
            
                    <div class="col-md-3 d-flex gap-2">
                        <button type="submit" class="btn btn-primary">Apply Filters</button>
                        <a href="{{ route('rooms') }}" class="btn btn-outline-secondary">Clear</a>
                    </div>
                </div>
            </form>
            
            @forelse ($rooms as $room)
                <div class="col-md-6 col-lg-4">
                    <div class="card room-card shadow-lg rounded">
                        <img src="{{ $room->images->first()->image_url ?? asset('default-room.jpg') }}"
                            class="card-img-top rounded-top" alt="Room Image">
                        <div class="card-body">
                            <h5 class="card-title text-primary" title="{{ $room->room_title }}">
                                🏷 {{ $room->room_title }}
                            </h5>

                            <p class="card-text text-muted mb-1" title="Location">
                                <i class="fas fa-map-marker-alt me-1"></i>
                                {{ ucwords($room->locality) }}, {{ ucwords($room->city) }}, {{ ucwords($room->state) }}
                            </p>

                            <p class="card-text mb-1 text-primary" title="Price">
                                <i class="fas fa-rupee-sign me-1"></i> {{ intval($room->room_price) }} / month
                            </p>

                            <p class="card-text mb-2" title="Capacity and Bathroom">
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
                                <span class="verified-badge">
                                    <svg width="30px" height="30px" viewBox="0 0 24 24" fill="#10b981"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12 2L3 6V11C3 16.52 6.84 21.74 12 23C17.16 21.74 21 16.52 21 11V6L12 2Z"
                                            stroke="white" stroke-width="1.7" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M9 12.5L11.25 14.75L15 11" stroke="white" stroke-width="1.7"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </span>

                                <small class="text-muted" title="{{ $room->created_at->format('d M Y, h:i A') }}">
                                    📅 {{ $room->created_at->diffForHumans() }}
                                </small>
                            </div>

                            <hr>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('room.show', ['id' => $room->room_id]) }}" class="button-69">
                                    View Room
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

        <div class="mt-4">
            {{ $rooms->appends(request()->query())->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
