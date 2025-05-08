@extends('layouts.app')
@section('title', 'Home')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/landing-page.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
@endpush
@section('content')
    <section id="hero-carousel" class="position-relative top-0">

        <!-- Full Page Image Background Carousel Header -->
        <div id="myCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">

            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-bs-target="#myCarousel" data-bs-slide-to="0" class="active"></li>
                <li data-bs-target="#myCarousel" data-bs-slide-to="1"></li>
                <li data-bs-target="#myCarousel" data-bs-slide-to="2"></li>
            </ol>

            <!-- Wrapper for Slides -->
            <div class="carousel-inner">
                @forelse ($rooms as $room)
                    @php

                        $firstImage = $room->images->first();
                        $roomImage =
                            $firstImage && $firstImage->image_url ? $firstImage->image_url : asset('default-room.jpg');
                    @endphp
                    @if ($loop->index == 0)
                        <div class="carousel-item active">
                            <!-- Set the first background image using inline CSS below. -->
                            <div class="fill"
                                style="background-image:url('{{ asset($roomImage) ?? 'http://www.marchettidesign.net/demo/optimized-bootstrap/campus.jpg' }}');">
                            </div>
                            <div class="carousel-caption">
                                <h2 class="animated fadeInLeft">{{ $room->room_title ?? '' }}</h2>
                                <p class="animated fadeInUp">{{ $room->room_description ?? '' }}</p>
                                <p class="animated fadeInUp"><a href="{{ route('room.show', ['id' => $room->room_id]) }}"
                                        class="btn btn-transparent btn-rounded btn-large">Book Now</a></p>
                            </div>
                        </div>
                    @elseif ($loop->index == 1)
                        <div class="carousel-item">
                            <!-- Set the second background image using inline CSS below. -->
                            <div class="fill"
                                style="background-image:url({{ asset($roomImage) ?? 'http://www.marchettidesign.net/demo/optimized-bootstrap/campus.jpg' }});">
                            </div>
                            <div class="carousel-caption">
                                <h2 class="animated fadeInDown">{{ $room->room_title ?? '' }}</h2>
                                <p class="animated fadeInUp">{{ $room->room_description ?? '' }}</p>
                                <p class="animated fadeInUp"><a href="{{ route('room.show', ['id' => $room->room_id]) }}"
                                        class="btn btn-transparent btn-rounded btn-large">Book Now</a></p>
                            </div>
                        </div>
                    @else
                        <div class="carousel-item">
                            <!-- Set the third background image using inline CSS below. -->
                            <div class="fill"
                                style="background-image:url({{ asset($roomImage) ?? 'http://www.marchettidesign.net/demo/optimized-bootstrap/campus.jpg' }});">
                            </div>
                            <div class="carousel-caption">
                                <h2 class="animated fadeInRight">{{ $room->room_title ?? '' }}</h2>
                                <p class="animated fadeInRight">{{ $room->room_description ?? '' }}</p>
                                <p class="animated fadeInRight"><a
                                        href="{{ route('room.show', ['id' => $room->room_id]) }}"
                                        class="btn btn-transparent btn-rounded btn-large">Book Now</a></p>
                            </div>
                        </div>
                    @endif

                @empty
                @endforelse

            </div>

            <!-- Controls -->
            <a class="carousel-control-prev" href="#myCarousel" role="button" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </a>
            <a class="carousel-control-next" href="#myCarousel" role="button" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </a>


        </div>


    </section>

    <div class="container my-5">

        <h2 class="display-5 fw-bold mb-3 heading" data-aos="fade-up">
            🏡 New Rooms
        </h2>

        <div class="row g-4">
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


    </div>

    <section class="py-5 bg-light" id="why-choose-us" data-aos="fade-up">

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 text-center mb-5">
                    <span class="custom-badge text-white mb-3 d-inline-block">Our Services</span>
                    <h2 class="display-5 fw-bold mb-3 heading">Why Choose RoomMitra</h2>
                    <p class="text-muted">Discover the reasons why RoomMitra is the best choice for students seeking
                        reliable room accommodations.</p>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="service-card h-100 p-4">
                        <div class="icon-wrapper mb-4">
                            <svg width="44px" height="44px" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M8.38 12L10.79 14.42L15.62 9.57996" stroke="white" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                <path
                                    d="M10.75 2.44995C11.44 1.85995 12.57 1.85995 13.27 2.44995L14.85 3.80995C15.15 4.06995 15.71 4.27995 16.11 4.27995H17.81C18.87 4.27995 19.74 5.14995 19.74 6.20995V7.90995C19.74 8.29995 19.95 8.86995 20.21 9.16995L21.57 10.7499C22.16 11.4399 22.16 12.5699 21.57 13.2699L20.21 14.8499C19.95 15.1499 19.74 15.7099 19.74 16.1099V17.8099C19.74 18.8699 18.87 19.7399 17.81 19.7399H16.11C15.72 19.7399 15.15 19.9499 14.85 20.2099L13.27 21.5699C12.58 22.1599 11.45 22.1599 10.75 21.5699L9.17 20.2099C8.87 19.9499 8.31 19.7399 7.91 19.7399H6.18C5.12 19.7399 4.25 18.8699 4.25 17.8099V16.0999C4.25 15.7099 4.04 15.1499 3.79 14.8499L2.44 13.2599C1.86 12.5699 1.86 11.4499 2.44 10.7599L3.79 9.16995C4.04 8.86995 4.25 8.30995 4.25 7.91995V6.19995C4.25 5.13995 5.12 4.26995 6.18 4.26995H7.91C8.3 4.26995 8.87 4.05995 9.17 3.79995L10.75 2.44995Z"
                                    stroke="white" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>

                        </div>
                        <h4 class="service-title text-center mb-3">Verified Listings</h4>
                        <p class="service-text text-center mb-0">All listed rooms are personally verified to ensure
                            safety,
                            comfort, and authenticity.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="service-card h-100 p-4">
                        <div class="icon-wrapper mb-4">
                            <svg width="44px" height="44px" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 2L4 5V11C4 16.52 7.87 21.74 12 23C16.13 21.74 20 16.52 20 11V5L12 2Z"
                                    stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>

                        </div>
                        <h4 class="service-title text-center mb-3">Safe & Secure Booking</h4>
                        <p class="service-text text-center mb-0">Secure SSL payments and trusted booking system for a
                            hassle-free experience.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="service-card h-100 p-4">
                        <div class="icon-wrapper mb-4">

                            <svg width="44px" height="44px" viewBox="0 0 48 48" id="Layer_1" version="1.1"
                                xml:space="preserve" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink">

                                <path stroke="white" class="st0"
                                    d="M14.302,41.5h19.385c1.551,0,2.813-1.262,2.813-2.813V34.37c0-4.822-3.654-8.77-8.38-9.197v-3.964  c2.291-1.412,3.71-3.917,3.71-6.628V11.5h0.67c0.276,0,0.5-0.224,0.5-0.5V7.585h2.5v2.625c0,0.276,0.224,0.5,0.5,0.5  s0.5-0.224,0.5-0.5V7.085c0-0.276-0.224-0.5-0.5-0.5h-3.5h-17H12c-0.276,0-0.5,0.224-0.5,0.5s0.224,0.5,0.5,0.5h3V11  c0,0.276,0.224,0.5,0.5,0.5h0.67v3.08c0,2.711,1.418,5.217,3.7,6.629v3.965c-4.735,0.436-8.38,4.381-8.38,9.197v4.317  C11.49,40.238,12.751,41.5,14.302,41.5z M25.732,25.12h-3.464H20.87v-3.377c0.98,0.432,2.045,0.667,3.13,0.667  c1.081,0,2.143-0.235,3.12-0.667v3.377H25.732z M25.098,26.12L24,30.692l-1.098-4.572H25.098z M16,7.585h16V10.5h-0.67H16.67H16  V7.585z M17.17,14.58V11.5h13.66v3.08c0,2.454-1.324,4.724-3.46,5.927c-2.045,1.185-4.712,1.181-6.753-0.002  C18.491,19.302,17.17,17.032,17.17,14.58z M12.49,34.37c0-4.44,3.47-8.06,7.921-8.242c0.107-0.009,0.221-0.009,0.329-0.008h1.134  l1.64,6.83c0.054,0.225,0.255,0.383,0.486,0.383s0.432-0.159,0.486-0.383l1.64-6.83h1.124c0.111,0.002,0.223,0,0.35,0.009  c4.43,0.181,7.9,3.8,7.9,8.241v4.317c0,1-0.813,1.813-1.813,1.813H14.302c-1,0-1.813-0.813-1.813-1.813V34.37z" />
                                <path stroke="white" class="st0"
                                    d="M16.083,33.81h4.287c0.276,0,0.5-0.224,0.5-0.5s-0.224-0.5-0.5-0.5h-4.287c-0.276,0-0.5,0.224-0.5,0.5  S15.807,33.81,16.083,33.81z" />
                            </svg>
                        </div>
                        <h4 class="service-title text-center mb-3">Designed for Students</h4>
                        <p class="service-text text-center mb-0">We specialize in student accommodations, with rooms
                            suited
                            for all study needs.</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="service-card h-100 p-4">
                        <div class="icon-wrapper mb-4">
                            <svg width="44px" height="44px" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 2L3 6V11C3 16.52 6.84 21.74 12 23C17.16 21.74 21 16.52 21 11V6L12 2Z"
                                    stroke="white" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M9 12.5L11.25 14.75L15 11" stroke="white" stroke-width="1.7"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>

                        </div>
                        <h4 class="service-title text-center mb-3">Owner KYC Verified
                        </h4>
                        <p class="service-text text-center mb-0">Room owners undergo thorough KYC verification before
                            being
                            listed, ensuring trustworthiness.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="service-card h-100 p-4">
                        <div class="icon-wrapper mb-4">
                            <svg fill="white" height="44px" width="44px" version="1.1" id="Layer_1"
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                viewBox="0 0 193.769 193.769" xml:space="preserve">
                                <g>
                                    <g>
                                        <g>
                                            <path
                                                d="M149.203,41.104l-9.348,12.009c20.15,15.679,30.201,41.063,26.234,66.253c-2.906,18.484-12.838,34.73-27.964,45.748
                                                                           c-15.131,11.012-33.64,15.488-52.124,12.567c-38.157-6.008-64.32-41.938-58.322-80.098C30.585,79.097,40.52,62.85,55.648,51.835
                                                                           c13.208-9.615,28.991-14.233,45.086-13.317L87.579,52.319l9.759,9.313l20.766-21.801l0.005,0.008l9.303-9.769l-9.752-9.303
                                                                           l-0.005,0.003L95.862,0l-9.31,9.769l14.2,13.525c-19.303-0.913-38.21,4.702-54.059,16.242
                                                                           C28.28,52.943,16.19,72.717,12.65,95.221c-7.302,46.445,24.54,90.184,70.985,97.493c4.489,0.708,8.976,1.055,13.434,1.055
                                                                           c17.89,0,35.273-5.623,50.011-16.356c18.415-13.409,30.503-33.183,34.043-55.682C185.952,91.077,173.72,60.181,149.203,41.104z" />
                                            <path
                                                d="M105.24,151.971v-0.003h0.001v-8.757c10.383-1.159,20.485-7.718,20.485-20.17c0-16.919-15.732-18.859-27.223-20.274
                                                                           c-7.347-0.878-12.97-1.897-12.97-6.348c0-6.188,8.722-6.855,12.473-6.855c5.567,0,11.507,2.617,13.525,5.957l0.586,0.971
                                                                           l11.542-5.341l-0.571-1.164c-4.301-8.793-12.009-11.337-17.85-12.364v-7.71H91.723v7.677
                                                                           c-12.582,1.856-20.054,8.839-20.054,18.829c0,16.29,14.791,17.943,25.582,19.153c9.617,1.134,14.094,3.51,14.094,7.469
                                                                           c0,7.563-10.474,8.154-13.685,8.154c-7.147,0-14.038-3.566-16.031-8.301l-0.495-1.169l-12.539,5.316l0.5,1.169
                                                                           c3.713,8.691,11.725,14.137,22.63,15.425v8.336H105.24z" />
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </div>
                        <h4 class="service-title text-center mb-3">Flexible Cancellation & Refund</h4>
                        <p class="service-text text-center mb-0">Our transparent cancellation and refund policy ensures
                            a
                            stress-free experience.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="service-card h-100 p-4">
                        <div class="icon-wrapper mb-4">
                            <svg height="44px" width="44px" version="1.1" id="Layer_1"
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                viewBox="0 0 491.52 491.52" xml:space="preserve">
                                <path style="fill:#3A556A;" d="M470.097,336.482h-26.81V219.955c0-106.379-88.612-192.926-197.528-192.926
                                                               S48.233,113.576,48.233,219.955v116.527h-26.81V219.955c0-121.277,100.635-219.943,224.335-219.943
                                                               c123.699,0,224.339,98.666,224.339,219.943V336.482z" />
                                <path style="fill:#EBF0F3;" d="M350.194,273.835v108.747c0,23.478,18.887,42.51,42.185,42.51V231.325
                                                               C369.081,231.325,350.194,250.357,350.194,273.835z" />
                                <path style="fill:#E1E6E9;" d="M392.379,231.325L392.379,231.325v193.768l0,0c23.298,0,42.185-19.033,42.185-42.51V273.835
                                                               C434.564,250.357,415.677,231.325,392.379,231.325z" />
                                <path style="fill:#64798A;" d="M434.564,270.813v114.79c31.456,0,56.956-25.697,56.956-57.395
                                                               C491.52,296.51,466.02,270.813,434.564,270.813z" />
                                <path style="fill:#EBF0F3;" d="M141.326,273.835v108.747c0,23.478-18.887,42.51-42.185,42.51V231.325
                                                               C122.439,231.325,141.326,250.357,141.326,273.835z" />
                                <path style="fill:#E1E6E9;" d="M99.141,231.325L99.141,231.325v193.768l0,0c-23.298,0-42.185-19.033-42.185-42.51V273.835
                                                               C56.956,250.357,75.843,231.325,99.141,231.325z" />
                                <g>
                                    <path style="fill:#64798A;"
                                        d="M56.956,270.813v114.79C25.5,385.604,0,359.907,0,328.209C0,296.51,25.5,270.813,56.956,270.813z" />
                                    <path style="fill:#64798A;" d="M267.88,481.232l-0.227-9.006c111.6-2.849,166.686-94.998,167.228-95.93l7.706,4.573
                                                                   C442.015,381.836,384.38,478.259,267.88,481.232z" />
                                </g>
                                <g>
                                    <path style="fill:#3A556A;" d="M472.701,347.484c4.184-8.686,0.589-19.143-8.029-23.36c-8.62-4.217-18.998-0.594-23.181,8.09
                                                                   c-3.076,6.384-1.921,13.705,2.316,18.823l-13.581,28.19l12.785,6.255l13.581-28.19
                                                                   C463.201,357.481,469.626,353.868,472.701,347.484z" />
                                    <ellipse style="fill:#3A556A;" cx="260.664" cy="475.712" rx="22.989"
                                        ry="15.795" />
                                </g>
                            </svg>
                        </div>
                        <h4 class="service-title text-center mb-3">24/7 Support</h4>
                        <p class="service-text text-center mb-0">Our dedicated customer support team is available 24/7
                            to
                            assist with any queries.</p>
                    </div>
                </div>
            </div>


        </div>
    </section>


    <section id="testimonials" class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 text-center">
                    <h2 class="display-5 fw-bold mb-3 heading">Testimonials</h2>
                    <div id="testimonialCarousel" class="carousel slide testimonial-carousel" data-bs-ride="carousel">
                        <!-- Indicators -->
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#testimonialCarousel" data-bs-slide-to="0"
                                class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#testimonialCarousel" data-bs-slide-to="1"
                                aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#testimonialCarousel" data-bs-slide-to="2"
                                aria-label="Slide 3"></button>
                        </div>

                        <!-- Slides -->
                        <div class="carousel-inner">
                            <div class="carousel-item active testimonial-item">
                                <div class="testimonial-img-box mx-auto">
                                    <img src="https://placehold.co/135x135" class="d-block img-fluid rounded-circle"
                                        alt="Paula Wilson">
                                </div>
                                <p class="testimonial-text mt-4">Lorem ipsum dolor sit amet...</p>
                                <p class="testimonial-overview"><b>Paula Wilson</b>, Media Analyst</p>
                            </div>
                            <div class="carousel-item testimonial-item">
                                <div class="testimonial-img-box mx-auto">
                                    <img src="https://placehold.co/135x135" class="d-block img-fluid rounded-circle"
                                        alt="Antonio Moreno">
                                </div>
                                <p class="testimonial-text mt-4">Vestibulum quis quam ut magna...</p>
                                <p class="testimonial-overview"><b>Antonio Moreno</b>, Web Developer</p>
                            </div>
                            <div class="carousel-item testimonial-item">
                                <div class="testimonial-img-box mx-auto">
                                    <img src="https://placehold.co/135x135" class="d-block img-fluid rounded-circle"
                                        alt="Michael Holz">
                                </div>
                                <p class="testimonial-text mt-4">Phasellus vitae suscipit justo...</p>
                                <p class="testimonial-overview"><b>Michael Holz</b>, SEO Analyst</p>
                            </div>
                        </div>

                        <!-- Controls -->
                        <button class="carousel-control-prev" type="button" data-bs-target="#testimonialCarousel"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#testimonialCarousel"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>




    <section class="py-5 " id="stats">
        <div class="container text-center">
            <h2 class="display-5 fw-bold mb-3 heading">Our Growing Community</h2>
            <div class="row g-4">
                <div class="col-md-3 col-6">
                    <div class="p-4 bg-white rounded shadow-sm">
                        <h3 class="counter text-success fw-bold" data-target="1000">0</h3>
                        <p class="mb-0">Rooms Listed</p>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="p-4 bg-white rounded shadow-sm">
                        <h3 class="counter text-success fw-bold" data-target="500">0</h3>
                        <p class="mb-0">Verified Owners</p>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="p-4 bg-white rounded shadow-sm">
                        <h3 class="counter text-success fw-bold" data-target="1500">0</h3>
                        <p class="mb-0">Happy Students</p>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="p-4 bg-white rounded shadow-sm">
                        <h3 class="counter text-success fw-bold" data-target="120">0</h3>
                        <p class="mb-0">Cities Covered</p>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection
@push('scripts')
    <link rel="stylesheet" href="{{ asset('js/landing.page.js') }}">

    <script>
        const counters = document.querySelectorAll(".counter");
        const speed = 200; // lower = faster

        const animateCounters = () => {
            counters.forEach((counter) => {
                const updateCount = () => {
                    const target = +counter.getAttribute("data-target");
                    const count = +counter.innerText;
                    const inc = Math.ceil(target / speed);

                    if (count < target) {
                        counter.innerText = count + inc;
                        setTimeout(updateCount, 30);
                    } else {
                        counter.innerText = target + "+";
                    }
                };
                updateCount();
            });
        };

        let started = false;
        window.addEventListener("scroll", () => {
            const statsSection = document.getElementById("stats");
            const sectionTop = statsSection.getBoundingClientRect().top;
            const screenHeight = window.innerHeight;

            if (!started && sectionTop < screenHeight) {
                started = true;
                animateCounters();
            }
        });
    </script>
@endpush
