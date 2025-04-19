@extends('layouts.owner')
@section('title', 'My Bookings')

@section('content')
    <div class="container my-4">

        <!-- 1. Page Title -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3>📖 My Bookings</h3>
        </div>

        <!-- 2. Summary Widgets -->
        <div class="row g-3 mb-4">
            <div class="col-md-3">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h6 class="text-muted">✅ Total Bookings</h6>
                        <h4>{{ $totalBookings }}</h4>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h6 class="text-muted">🛏️ Upcoming Check-ins</h6>
                        <h4>{{ $upcomingCheckins }}</h4>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h6 class="text-muted">🔴 Cancellations</h6>
                        <h4>{{ $cancelledCount }}</h4>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h6 class="text-muted">💰 Total Earnings</h6>
                        <h4>₹{{ number_format($totalEarnings) }}</h4>
                    </div>
                </div>
            </div>
        </div>

        <!-- 3. Filters -->
        <form method="GET" class="row g-2 mb-3">
            <div class="col-md-3">
                <input type="text" class="form-control" name="booking_id" placeholder="🔍 Booking ID">
            </div>
            <div class="col-md-3">
                <input type="text" class="form-control" name="user" placeholder="User name / email">
            </div>
            <div class="col-md-2">
                <select class="form-select" name="status">
                    <option value="">All Status</option>
                    <option value="Pending">Pending</option>
                    <option value="Confirmed">Confirmed</option>
                    <option value="Cancelled">Cancelled</option>
                    <option value="Checked-in">Checked-in</option>
                    <option value="Completed">Completed</option>
                </select>
            </div>
            <div class="col-md-2">
                <input type="date" name="checkin_from" class="form-control" placeholder="From date">
            </div>
            <div class="col-md-2">
                <input type="date" name="checkin_to" class="form-control" placeholder="To date">
            </div>
        </form>

        <!-- 4. Bookings Table -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle text-center">
                <thead class="table-light">
                    <tr>
                        <th>Booking ID</th>
                        <th>Room</th>
                        <th>User</th>
                        <th>Check-in</th>
                        <th>Check-out</th>
                        <th>Status</th>
                        <th>Payment</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bookings as $booking)
                        <tr>
                            <td>#{{ $booking->id }}</td>
                            <td>
                                <a href="{{ route('owner.rooms.show', $booking->room_id) }}">{{ $booking->room->title }}</a>
                            </td>
                            <td>
                                {{ $booking->user->name }}
                                <small class="d-block text-muted"
                                    title="{{ $booking->user->email }}">{{ $booking->user->email }}</small>
                            </td>
                            <td>{{ $booking->check_in }}</td>
                            <td>{{ $booking->check_out }}</td>
                            <td>
                                <span
                                    class="badge bg-{{ $booking->status == 'Confirmed'
                                        ? 'success'
                                        : ($booking->status == 'Cancelled'
                                            ? 'danger'
                                            : ($booking->status == 'Completed'
                                                ? 'secondary'
                                                : 'warning')) }}">
                                    {{ $booking->status }}
                                </span>
                            </td>
                            <td>₹{{ number_format($booking->payment_amount) }}</td>
                            <td class="d-flex justify-content-center gap-2 flex-wrap">
                                <button class="btn btn-sm btn-outline-info" data-bs-toggle="modal"
                                    data-bs-target="#viewBookingModal" data-id="{{ $booking->id }}">👁️</button>
                                <!-- Optional View Invoice -->
                                <a href="{{ route('owner.bookings.invoice', $booking->id) }}"
                                    class="btn btn-sm btn-outline-secondary">📄</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-3">
            {{ $bookings->links('pagination::bootstrap-5') }}
        </div>
    </div>

    <!-- 5. Booking Detail Modal -->
    <div class="modal fade" id="viewBookingModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">📄 Booking Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <!-- Dynamic content load via JS or Livewire -->
                    <p>Loading booking details...</p>
                </div>
            </div>
        </div>
    </div>

@endsection
