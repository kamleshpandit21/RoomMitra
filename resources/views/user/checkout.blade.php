@extends('layouts.app')
@section('title', 'Invoice')

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/user.profile.css') }}">

    <style>
        body {
            background-color: #f8f9fa;
        }

        .Billing-container {
            font-family: 'Poppins', sans-serif;
        }

        .booking-card {
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
        }

        /* .booking-card:hover {
                                                                transform: scale(1.02);
                                                            } */

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

    <div class="container" style="padding: 160px 0 80px 0;">
        <h2 class="display-5 fw-bold  heading">Confirm Your Booking</h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('rooms') }}">Rooms</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $room->room_title }}</li>
            </ol>
        </nav>
        <div class="row g-4  Billing-container">
            <!-- Room Summary -->
            <div class="col-md-5">
                <div class="booking-card">
                    <h3 class="mb-3 fw-bold ">Room Summary</h3>



                    <div class="mb-3">
                        <label>Stay Months</label>
                        <select name="months" class="form-select" id="stayMonths">
                            @for ($i = $room->min_stay_months; $i <= 12; $i++)
                                <option value="{{ $i }}">{{ $i }} month{{ $i > 1 ? 's' : '' }}
                                </option>
                            @endfor
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Occupancy</label>
                        <select name="occupancy" class="form-select" id="occupancySelect">
                            @for ($i = 1; $i <= $room->room_capacity; $i++)
                                <option value="{{ $i }}">{{ $i }} Person{{ $i > 1 ? 's' : '' }}
                                </option>
                            @endfor

                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="checkinDate">Check-in Date</label>
                        <input type="text" id="checkinDate" name="checkin_date" class="form-control"
                            placeholder="DD-MM-YYYY" required>
                    </div>

                    <div class="mb-3">
                        <label for="checkoutDate">Checkout Date</label>
                        <input type="text" id="checkoutDate" name="checkout_date" class="form-control"
                            placeholder="DD-MM-YYYY" readonly>
                    </div>



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

                @endphp

                <!-- Pricing Breakdown -->
                <div class="booking-card ">
                    <h5>Billing Details</h5>
                    <table class="table table-sm table-borderless">
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

                            @if ($amenitiesTotal > 0)
                                <tr>
                                    <td>Total Amenity Charges</td>
                                    <td>₹ {{ $amenitiesTotal }} / month</td>
                                </tr>
                            @endif

                            <tr class="border-top border-bottom">
                                <td><strong>Total</strong></td>
                                <td><strong id="totalAmount">₹ 0</strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- Policies -->
                <div class="booking-card">


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
                        <input type="hidden" name="checkin_date" id="checkinDateInput">
                        <input type="hidden" name="checkout_date" id="checkoutDateInput">
                        <input type="hidden" name="months" id="selectedMonths">
                        <input type="hidden" name="occupancy" id="selectedOccupancy">
                        <input type="hidden" name="total" id="totalPrice">

                        <div class="text-end">
                            <a href="{{ url()->previous() }}" class="btn fill-btn me-2">Back to Room</a>
                            <button type="submit" class="btn submit-btn" id="confirmPayBtn">Confirm & Pay</button>
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
    <script>
        const stayMonthsEl = document.getElementById("stayMonths");
        const occupancy = document.getElementById("occupancySelect");
        const totalAmountEl = document.getElementById("totalAmount");
        const checkinDateEl = document.getElementById("checkinDate");
        const checkoutDateEl = document.getElementById("checkoutDate");

        let baseRent = {{ $baseRent }};
        const security = {{ $securityDeposit }};
        const amenities = {{ $amenitiesTotal }};

        occupancy.addEventListener("change", function() {
            console.log("Occupancy changed:", occupancy.value);
            const occupancyValue = parseInt(occupancy.value);
            
            if (occupancyValue == 1) {
                baseRent = {{ $room->sharing_prices['single'] ?? $baseRent}};
            } else if (occupancyValue == 2) {
                baseRent = {{ $room->sharing_prices['double'] ?? $baseRent}};
            } else {
                baseRent = {{ $room->sharing_prices['triple'] ?? $baseRent}};
            }
            console.log("Base Rent:", baseRent);



            calculateTotal();
        });

        function calculateTotal() {
            const months = parseInt(stayMonthsEl.value || 1);
            const total = (baseRent + amenities) * months + security;
            totalAmountEl.innerText = `₹ ${total} ( For ${months} Months Only)`;
            console.log(`Total: ₹ ${total} ( For ${months} Months Only) ${baseRent} + ${amenities} + ${security}`);
        }

        function formatDateMMDDYYYY(date) {
            const mm = String(date.getMonth() + 1).padStart(2, '0');
            const dd = String(date.getDate()).padStart(2, '0');
            const yyyy = date.getFullYear();
            return `${dd}-${mm}-${yyyy}`;
        }

        function updateCheckoutDate() {
            const checkInVal = checkinDateEl.value;
            if (!checkInVal) return;

            const [dd, mm, yyyy] = checkInVal.split('-').map(Number);
            const checkInDate = new Date(yyyy, mm - 1, dd);
            const months = parseInt(stayMonthsEl.value || 1);
            const checkout = new Date(checkInDate);
            checkout.setMonth(checkInDate.getMonth() + months);

            checkoutDateEl.value = formatDateMMDDYYYY(checkout);
        }

        // Initial setup
        document.addEventListener('DOMContentLoaded', () => {
            calculateTotal();
            updateCheckoutDate();
            
        });

        // Event listeners
        stayMonthsEl.addEventListener('change', () => {
            calculateTotal();
            updateCheckoutDate();
        });

        checkinDateEl.addEventListener('change', updateCheckoutDate);

        // Final submit logic
        document.getElementById("confirmPayBtn").addEventListener("click", function() {
            document.getElementById("selectedMonths").value = stayMonthsEl.value;
            document.getElementById("selectedOccupancy").value = occupancy.value;
            document.getElementById("totalPrice").value = totalAmountEl.innerText.replace(/[^\d]/g, '');
            document.getElementById("checkinDateInput").value = checkinDateEl.value;
            document.getElementById("checkoutDateInput").value = checkoutDateEl.value;
        });
    </script>
@endpush
