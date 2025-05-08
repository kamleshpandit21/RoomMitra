@extends('layouts.app')
@section('title', 'Room Details')

@push('styles')
    <style>
        .amenity-card {
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 10px;
            text-align: center;
            min-width: 120px;
            background: #f9f9f9;
        }

        .badge-free {
            background-color: #d4edda;
            color: #155724;
        }

        .badge-paid {
            background-color: #f8d7da;
            color: #721c24;
        }

        .spec-item i {
            color: #0d6efd;
        }

        .hover-shadow:hover {
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        .sticky-action {
            position: sticky;
            top: 160px;
            z-index: 1000;
            background: #fff;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        @media (max-width: 768px) {
            .sticky-action {
                position: static;
                margin-top: 20px;
            }
        }

        .room-details-container {
            font-family: 'Poppins', sans-serif;
        }
    </style>
@endpush

@section('content')
    <div class="container room-details-container" style="padding: 160px 0 80px 0;">
        <section class="text-center bg-light">
            <div class="container">
                <h1 class="display-5 fw-bold  heading">{{ $room->room_title }}</h1>

            </div>
        </section>

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('rooms') }}">Rooms</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $room->room_title }}</li>
            </ol>
        </nav>

        <div class="row g-4">
            <div class="col-lg-8">
                <!-- Image Gallery -->
                <div id="roomGallery" class="carousel slide mb-4" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @foreach ($room->images as $index => $image)
                            <div class="carousel-item @if ($index == 0) active @endif">
                                <img src="{{ asset($image->image_url) }}" class="d-block w-100" alt="Room Image"
                                    height="400">
                            </div>
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#roomGallery" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#roomGallery" data-bs-slide="next">
                        <span class="carousel-control-next-icon"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>

                <!-- Room Info -->
                <div class="card p-3 mb-4">
                    <h5><i class="fas fa-info-circle me-2"></i> Room Information</h5>
                    <p><strong>No.:</strong> {{ $room->room_number }}</p>
                    <p><strong>Capacity:</strong> {{ $room->room_capacity }} People</p>
                    <p><strong>Total Beds:</strong> {{ $room->total_beds }}</p>
                    <p><strong>Description:</strong> {{ $room->room_description }}</p>

                </div>

                <!-- Specifications -->
                <div class="card p-3 mb-4">
                    <h5><i class="fas fa-cogs me-2"></i> Specifications</h5>
                    <div class="row g-3">
                        <div class="col-md-6 spec-item"><i class="fa fa-bath me-2"></i> <strong>Bathroom:</strong>
                            {{ ucfirst($room->bathroom_type) }}</div>
                        <div class="col-md-6 spec-item"><i class="fa fa-utensils me-2"></i> <strong>Kitchen:</strong>
                            {{ ucfirst($room->kitchen_type) }}</div>
                        <div class="col-md-6 spec-item"><i class="fa fa-building me-2"></i> <strong>Floor:</strong>
                            {{ $room->floor }}</div>
                        <div class="col-md-6 spec-item"><i class="fa fa-elevator me-2"></i> <strong>Lift:</strong>
                            {{ $room->lift ? 'Available' : 'Not Available' }}</div>
                        <div class="col-md-6 spec-item"><i class="fa fa-car me-2"></i> <strong>Parking:</strong>
                            {{ $room->parking ? 'Available' : 'Not Available' }}</div>
                        <div class="col-md-6 spec-item"><i class="fa fa-bolt me-2"></i> <strong>Light:</strong>
                            {{ ucfirst($room->light ?? 'Normal') }}</div>
                    </div>
                </div>

                <!-- Amenities -->
                <div class="card p-3 mb-4">
                    <h5>Amenities</h5>
                    <div class="d-flex flex-wrap gap-3">
                        @foreach ($room->amenities as $amenity)
                            <div class="amenity-card">
                                <i
                                    class="fas fa-{{ $icons[strtolower($amenity->amenity_name)] ?? 'concierge-bell' }} fa-lg mb-1"></i>
                                <div>{{ $amenity->amenity_name }}</div>
                                <div
                                    class="badge bg-{{ $amenity->status == 'free' ? 'success' : ($amenity->status == 'paid' ? 'warning' : 'secondary') }}">
                                    {{ ucfirst($amenity->status) }}</div>
                                @if ($amenity->status == 'paid')
                                    <div>₹{{ number_format($amenity->price) }}/month</div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Location -->
                <div class="card p-3 mb-4">
                    <h4>Location</h4>
                    <p><strong>Address Line 1:</strong> {{ $room->address_line1 }}</p>
                    <p><strong>Address Line 2:</strong> {{ $room->address_line2 }}</p>
                    <p><strong>Locality:</strong> {{ $room->locality }}</p>
                    <p><strong>Country:</strong> {{ $room->country }}</p>
                    <p><strong>City:</strong> {{ $room->city }}</p>
                    <p><strong>State:</strong> {{ $room->state }}</p>
                    <p><strong>Pincode:</strong> {{ $room->pincode }}</p>
                    <p><strong>Nearby Landmarks:</strong> {{ $room->nearby_landmarks }}</p>
                    <iframe
                        src="https://maps.google.com/maps?q={{ urlencode($room->city) }}&t=&z=13&ie=UTF8&iwloc=&output=embed"
                        width="100%" height="300" frameborder="0" style="border:0;"></iframe>
                </div>

                <!-- Reviews -->
                <div class="card p-3 mb-4">
                    <h5>Reviews</h5>
                    @forelse ($room->reviews as $review)
                        <div class="mb-2">
                            <strong>{{ $review->user->name }}</strong> <span class="text-warning">
                                @for ($i = 0; $i < $review->rating; $i++)
                                    <i class="fa fa-star"></i>
                                @endfor
                            </span>
                            <p>{{ $review->comment }}</p>
                        </div>
                    @empty
                        <p>No reviews yet.</p>
                    @endforelse
                </div>

                <!-- Timings -->
                <div class="card p-3 mb-4">
                    <h5>Timings & Restrictions</h5>
                    <p><strong>Entry:</strong> {{ date('h:i A', strtotime($room->entry_time)) }} | <strong>Exit:</strong>
                        {{ date('h:i A', strtotime($room->exit_time)) }}</p>
                    <p><strong>Restrictions:</strong> {{ $room->restrictions }}</p>
                </div>
            </div>

            <!-- Right Column -->
            <div class="col-lg-4">
                <div class="sticky-action">
                    <div class="card p-3 mb-4">
                        <h5>Pricing</h5>
                        <ul class="list-group">
                            <li class="list-group-item">Price: ₹{{ intval($room->room_price) }}/month</li>
                            <li class="list-group-item">Security Deposit: ₹{{ intval($room->security_deposit) }}</li>
                            @foreach ($room->sharing_prices as $key => $price)
                                <li class="list-group-item">{{ ucwords($key) }}: ₹{{ intval($price) }}/month</li>
                            @endforeach
                            <li class="list-group-item">Minimun Stay: {{ $room->min_stay_months }} month</li>
                        </ul>
                    </div>
                    <div class="card p-3 mb-4">
                        <h5>Owner Info</h5>
                        <p><strong>Name:</strong> {{ ucwords($room->owner->full_name) }}</p>
                        <p><strong>Contact:</strong> {{ substr($room->owner->phone, 0, 4) . '********' }}</p>
                        <p><strong>Rating:</strong> <span class="text-warning"><i class="fa fa-star"></i> 4.5</span></p>
                    </div>

                    <div class="card p-3 mb-4">
                       
                        <form action="{{ route('user.booking.checkout', $room->room_id) }}" method="GET" id="bookingForm">
                       
                    
                            <button type="submit" class="btn submit-btn w-100"><i class="fa fa-calendar-check"></i> Book Now</button>
                        </form>
                    </div>
                    


                </div>
            </div>
        </div>
    </div>
@endsection


@push('scripts')
    <script>
        document.getElementById('bookNow').addEventListener('click', function() {
            window.location.href = "{{ route('user.booking.checkout', $room->room_id) }}";
        });
    </script>
 
  
@endpush
