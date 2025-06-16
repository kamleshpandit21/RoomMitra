@extends('layouts.app')
@section('title', 'My Wishlist')
@section('content')

    <div class="container my-5" style="padding-top: 100px;">
        <h2 class="display-5 fw-bold mb-3 heading" data-aos="fade-up">💖 My Wishlist</h2>

        <div class="row g-4">
            <div class="col-12" data-aos="fade-up" id="empty-wishlist-message"
                style="{{ count($wishlists) ? 'display:none;' : '' }}">
                <div class="alert alert-warning text-center">
                    <strong>No rooms in your wishlist yet.</strong>
                </div>
            </div>
            @forelse($wishlists as $item)
                @php
                    $room = $item->room;
                    $delay = $loop->index * 100;
                @endphp
                <div class="col-md-6 col-lg-4">
                    <div class="card room-card shadow-lg rounded" data-aos="fade-up" data-aos-delay="{{ $delay }}">
                        <img src="{{ $room->images->first()->image_url ?? asset('default-room.jpg') }}"
                            class="card-img-top rounded-top" alt="Room Image">

                        <div class="card-body">
                            <h5 class="card-title text-primary" title="{{ $room->room_title }}">
                                🏷 {{ $room->room_title }}
                            </h5>

                            <p class="card-text text-muted mb-1">
                                <i class="fas fa-map-marker-alt me-1"></i>
                                {{ ucwords($room->locality) }}, {{ ucwords($room->city) }}, {{ ucwords($room->state) }}
                            </p>

                            <p class="card-text text-primary mb-1">
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
                                        <i class="fas {{ $icons[$amenity->amenity_name] ?? 'fa-concierge-bell' }}"></i>
                                        {{ $amenity->amenity_name }}
                                    </span>
                                @endforeach
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="verified-badge">
                                    <svg width="28px" height="28px" viewBox="0 0 24 24" fill="#10b981"
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
                                <a href="{{ route('room.show', $room->room_id) }}" class="button-69">
                                    View Room
                                </a>
                                <button class="btn btn-sm btn-danger" onclick="toggleWishlist({{ $room->room_id }})"
                                    id="wishlist-btn-{{ $room->room_id }}">
                                    <i class="fas fa-heart"></i> Remove
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @empty

            @endforelse
        </div>
    </div>

@endsection
@push('scripts')
    <script>
        function toggleWishlist(roomId) {
            const button = document.getElementById(`wishlist-btn-${roomId}`);
            if (!button) return;

            fetch(`/wishlist/toggle/${roomId}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                })
                .then(async response => {
                    if (response.status === 401) {
                        Toast.fire({
                            icon: 'warning',
                            title: 'Please login to manage wishlist'
                        });
                        return;
                    }

                    if (!response.ok) {
                        const errorData = await response.json();
                        Toast.fire({
                            icon: 'error',
                            title: errorData.message || 'Something went wrong!'
                        });
                        return;
                    }

                    return response.json();
                })
                .then(data => {
                    if (!data) return;

                    const cardCol = button.closest('.col-md-6') || button.closest('.col-lg-4');

                    if (data.status === 'removed') {
                        Toast.fire({
                            icon: 'info',
                            title: 'Removed from wishlist'
                        });

                        // Animate before removing
                        if (cardCol) {
                            cardCol.classList.add('animate__animated', 'animate__fadeOut');
                            setTimeout(() => {
                                cardCol.remove();
                                const remainingRooms = document.querySelectorAll('.room-card');
                                if (remainingRooms.length === 0) {
                                    document.getElementById('empty-wishlist-message').style.display = 'block';
                                }
                            }, 500);
                        }

                    } else if (data.status === 'added') {
                        Toast.fire({
                            icon: 'success',
                            title: 'Added to wishlist'
                        });
                    }
                })
                .catch(error => {
                    console.error('Wishlist toggle error:', error);
                    Toast.fire({
                        icon: 'error',
                        title: 'Unexpected error occurred.'
                    });
                });
        }
    </script>
@endpush
