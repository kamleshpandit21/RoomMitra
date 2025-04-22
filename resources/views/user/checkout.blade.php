@extends('layouts.app')
@section('title', 'Invoice')

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/user.profile.css') }}">

    <style>
        body {
            background-color: #f8f9fa;
        }

        .booking-card {
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
        }

        .booking-card:hover {
            transform: scale(1.02);
        }

        .free-tag {
            color: green;
            font-weight: bold;
        }

        .secure-icon {
            color: green;
            margin-left: 10px;
        }

        .btn-custom {
            background-color: #007bff;
            color: white;
        }

        .btn-custom:hover {
            background-color: #0056b3;
        }

        .form-check-input:checked {
            background-color: #007bff;
            border-color: #007bff;
        }

        .policy-icon {
            font-size: 1.2rem;
        }
    </style>
@endpush
@section('content')
    @php
        if (Auth::check()) {
            $user = Auth::user();
        }
    @endphp

    <div class="container py-5">
        <h2 class="mb-4 text-center">Confirm Your Booking</h2>
        <div class="row g-4">
            <!-- Room Summary -->
            <div class="col-md-5">
                <div class="booking-card">
                    <h5>Room Summary</h5>

                    <div id="roomGallery" class="carousel slide mb-4" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="{{ asset($room->images->first()->image_url) }}" class="d-block w-100"
                                    alt="..." height="400px">
                            </div>
                            @foreach ($room->images->skip(1) as $image)
                                <div class="carousel-item">
                                    <img src="{{ asset($image->image_url) }}" class="d-block w-100" alt="Room Image"
                                        height="400px">
                                </div>
                            @endforeach


                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#roomGallery"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#roomGallery"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
    <p><strong>Title:</strong> {{ $room->room_title }}</p>
                    <p><strong>Location:</strong>{{ $room->city }}, {{ $room->state }}</p>
                    <p><strong>Room Capacity:</strong> {{ $room->room_capacity }}</p>
                    <input type="date" class="form-control mb-2" />
                    <label><strong>Duration:</strong></label>
                    <select class="form-select mb-2">
                        <option>1 Month</option>
                        <option>6 Months</option>
                        <option>Custom</option>
                    </select>
                    <label><strong>Selected Amenities:</strong></label>
                    <ul class="list-unstyled">
                        @foreach ($room->amenities as $amenity)
                            <li>{{ $amenity->amenity_name }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <!-- Billing & User Info -->
            <div class="col-md-7">
                @php
                    $baseRent = intval($room->room_price);
                    $securityDeposit = intval($room->security_deposit);

                    // Sum all paid amenities
                    $amenitiesTotal = 0;
                    foreach ($room->amenities as $amenity) {
                        if ($amenity->status == 'paid') {
                            $amenitiesTotal += intval($amenity->price);
                        }
                    }

                    // Final Total
                    $total = $baseRent + $securityDeposit + $amenitiesTotal;
                @endphp

                <!-- Pricing Breakdown -->
                <div class="booking-card">
                    <h5>Billing Details</h5>
                    <table class="table table-sm">
                        <tbody>
                            <tr>
                                <td>Base Rent</td>
                                <td>₹ {{ intval($room->room_price) }} / month</td>
                            </tr>
                            <tr>
                                <td>Security Deposit</td>
                                <td>₹ {{ intval($room->security_deposit) }} / month</td>
                            </tr>

                            @forelse ($room->amenities as $amenity)
                                <tr>
                                    <td>{{ $amenity->amenity_name }}</td>
                                    @if ($amenity->status == 'free')
                                        <td><span class="free-tag">Free</span></td>
                                    @else
                                        <td>₹ {{ intval($amenity->price) }} / month</td>
                                    @endif

                                </tr>

                            @empty
                            @endforelse
                            <tr>
                                @if ($amenitiesTotal > 0)
                            <tr>
                                <td>Amenity Charges</td>
                                <td>₹ {{ $amenitiesTotal }} / month</td>
                            </tr>
                            @endif

                            <td><strong>Total</strong></td>
                            <td><strong>₹ {{ $total }}</strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- User Info -->
                <div class="booking-card">
                    <h5>Your Information</h5>
                    <div class="row g-2">
                        <div class="col-md-6">
                            <label class="form-label">Name:</label>
                            <p class="form-control-plaintext">{{ $user->full_name ?? 'N/A' }}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email:</label>
                            <p class="form-control-plaintext">{{ $user->email ?? 'N/A' }}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Phone:</label>
                            <p class="form-control-plaintext">{{ $user->phone ?? 'N/A' }}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">College Name:</label>
                            <p class="form-control-plaintext">{{ $user->profile->college_name ?? 'N/A' }}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Course:</label>
                            <p class="form-control-plaintext">{{ $user->profile->course ?? 'N/A' }}</p>
                        </div>
                        <div class="col-md-6">
                            <label>ID Card:</label>
                            <p><a href="{{ asset($user->profile->id_card_url) ?? '#' }}"
                                    class="btn btn-sm btn-outline-secondary">View /
                                    Download</a> </p>

                        </div>
                    </div>
                </div>

                {{-- <!-- Payment Method -->

                <div class="booking-card">
                    <h5>Payment Method</h5>
                    <div class="form-check mb-3 payment-option">
                        <input type="radio" name="payment" class="form-check-input" id="credit-card" />
                        <label class="form-check-label" for="credit-card">
                            <i class="fab fa-cc-visa fa-2x"></i>
                            <span class="ms-2">Credit/Debit Card</span>
                        </label>
                        <div class="card-details mt-2">
                            <input type="text" class="form-control mb-2" placeholder="Card Number" />
                            <div class="row g-2">
                                <div class="col-6">
                                    <input type="text" class="form-control" placeholder="MM/YY" />
                                </div>
                                <div class="col-6">
                                    <input type="text" class="form-control" placeholder="CVV" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-check mb-3 payment-option">
                        <input type="radio" name="payment" class="form-check-input" id="paypal" />
                        <label class="form-check-label" for="paypal">
                            <i class="fab fa-paypal fa-2x"></i>
                            <span class="ms-2">PayPal</span>
                        </label>
                    </div>
                    <div class="form-check mb-3 payment-option">
                        <input type="radio" name="payment" class="form-check-input" id="bank-transfer" />
                        <label class="form-check-label" for="bank-transfer">
                            <i class="fas fa-university fa-2x"></i>
                            <span class="ms-2">Bank Transfer</span>
                        </label>
                    </div>
                    <div class="form-check mb-3 payment-option">
                        <input type="radio" name="payment" class="form-check-input" id="upi" />
                        <label class="form-check-label" for="upi">
                            <i class="fas fa-qrcode fa-2x"></i>
                            <span class="ms-2">UPI</span>
                        </label>
                    </div>
                    <div class="form-check mb-3 payment-option">
                        <input type="radio" name="payment" class="form-check-input" id="net-banking" />
                        <label class="form-check-label" for="net-banking">
                            <i class="fas fa-university fa-2x"></i>
                            <span class="ms-2">Net Banking</span>
                        </label>
                    </div>


                    <span class="secure-icon"><i class="fa fa-lock"></i> Secure Payment</span>
                </div> --}}

                <div class="accordion" id="policyAccordion">

                    <!-- Refund Policy -->
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#policyRefund">
                                Refund Policy
                            </button>
                        </h2>
                        <div id="policyRefund" class="accordion-collapse collapse" data-bs-parent="#policyAccordion">
                            <div class="accordion-body">
                                Full refund if cancelled 48 hours before check-in.
                            </div>
                        </div>
                    </div>

                    <!-- Check-in / Check-out Policy -->
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#policyCheckin">
                                Check-in / Check-out Policy
                            </button>
                        </h2>
                        <div id="policyCheckin" class="accordion-collapse collapse" data-bs-parent="#policyAccordion">
                            <div class="accordion-body">
                                Check-in time: 12:00 PM | Check-out time: 11:00 AM. Early check-in subject to availability.
                            </div>
                        </div>
                    </div>

                    <!-- Guest Policy -->
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#policyGuest">
                                Guest Policy
                            </button>
                        </h2>
                        <div id="policyGuest" class="accordion-collapse collapse" data-bs-parent="#policyAccordion">
                            <div class="accordion-body">
                                No outside guests allowed after 10:00 PM. Overnight stays by guests are strictly prohibited.
                            </div>
                        </div>
                    </div>

                    <!-- Smoking Policy -->
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#policySmoking">
                                Smoking Policy
                            </button>
                        </h2>
                        <div id="policySmoking" class="accordion-collapse collapse" data-bs-parent="#policyAccordion">
                            <div class="accordion-body">
                                Smoking is not permitted inside the rooms. Designated smoking areas are available outside
                                the building.
                            </div>
                        </div>
                    </div>

                    <!-- Noise Policy -->
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#policyNoise">
                                Noise Policy
                            </button>
                        </h2>
                        <div id="policyNoise" class="accordion-collapse collapse" data-bs-parent="#policyAccordion">
                            <div class="accordion-body">
                                Quiet hours are from 10:00 PM to 7:00 AM. Please respect other guests by keeping noise to a
                                minimum.
                            </div>
                        </div>
                    </div>

                </div>



                <!-- Policies -->
                <div class="booking-card">
                    <h5>Policies</h5>
                    <ul class="small" style="list-style-type: none">
                        <li>
                            <i class="policy-icon fas fa-clock"></i> Check-in: 10 AM |
                            Check-out: 9 AM
                        </li>
                        <li>
                            <i class="policy-icon fas fa-ban"></i> {{ $room->restrictions }}
                        </li>
                        <li>
                            <i class="policy-icon fas fa-file-alt"></i> Cancellation before
                            48 hours: Full Refund
                        </li>
                    </ul>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="agree" />
                        <label class="form-check-label" for="agree">I Agree to Terms & Conditions</label>
                    </div>
                </div>

                <!-- Final Action -->
                <div class="text-end">
                    <form method="POST" action="{{ route('user.booking.pay', $room->room_id) }}">
                        @csrf
                        <!-- Your user inputs and hidden fields if needed -->

                        <div class="text-end">
                            <a href="{{ route('rooms') }}" class="btn btn-secondary me-2">Back to Room</a>
                            <button type="submit" class="btn btn-custom" id="confirmPayBtn">Confirm & Pay</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="confirmationModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body text-center p-5">
                    <i class="fas fa-check-circle fa-4x text-success mb-4"></i>
                    <h3>Booking Confirmed!</h3>
                    <p>We've sent confirmation details to your email</p>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('scripts')
    <!-- Bootstrap Bundle with Popper (v5) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YOUR-INTEGRITY-HERE" crossorigin="anonymous"></script>
    <script>
        // Add real-time validation
        document.querySelectorAll("input").forEach((input) => {
            input.addEventListener("blur", (e) => {
                if (!e.target.value) {
                    e.target.classList.add("is-invalid");
                } else {
                    e.target.classList.remove("is-invalid");
                }
            });
        });
    </script>
@endpush
