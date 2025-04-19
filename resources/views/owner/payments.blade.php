@extends('layouts.owner')
@section('title', 'Payments')

@section('content')
<div class="container my-4">

    <!-- 1. Page Title -->
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h3>📖 My Payments</h3>
    </div>
  
    <!-- 2. Summary Widgets -->
    <div class="row g-3 mb-4">
      <div class="col-md-3">
        <div class="card shadow-sm border-0">
          <div class="card-body">
            <h6 class="text-muted">✅ Total Payments</h6>
            <h4>{{ $totalPayments }}</h4>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card shadow-sm border-0">
          <div class="card-body">
            <h6 class="text-muted">💰 Total Earnings This Month</h6>
            <h4>₹{{ number_format($monthlyEarnings) }}</h4>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card shadow-sm border-0">
          <div class="card-body">
            <h6 class="text-muted">🔴 Pending Payments</h6>
            <h4>{{ $pendingPayments }}</h4>
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
        <select class="form-select" name="payment_status">
          <option value="">All Status</option>
          <option value="Paid">Paid</option>
          <option value="Pending">Pending</option>
          <option value="Failed">Failed</option>
          <option value="Refunded">Refunded</option>
        </select>
      </div>
      <div class="col-md-2">
        <select class="form-select" name="payment_method">
          <option value="">All Methods</option>
          <option value="Credit Card">Credit Card</option>
          <option value="PayPal">PayPal</option>
          <option value="Bank Transfer">Bank Transfer</option>
        </select>
      </div>
      <div class="col-md-2">
        <input type="date" name="payment_from" class="form-control" placeholder="From date">
      </div>
      <div class="col-md-2">
        <input type="date" name="payment_to" class="form-control" placeholder="To date">
      </div>
    </form>
  
    <!-- 4. Payments Table -->
    <div class="table-responsive">
      <table class="table table-bordered table-hover align-middle text-center">
        <thead class="table-light">
          <tr>
            <th>Payment ID</th>
            <th>Booking ID</th>
            <th>User</th>
            <th>Amount</th>
            <th>Payment Status</th>
            <th>Payment Method</th>
            <th>Payment Date</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach($payments as $payment)
          <tr>
            <td>#{{ $payment->id }}</td>
            <td>
              <a href="{{ route('owner.bookings.show', $payment->booking_id) }}">#{{ $payment->booking_id }}</a>
            </td>
            <td>
              <a href="{{ route('owner.users.show', $payment->user_id) }}">{{ $payment->user->name }}</a>
            </td>
            <td>₹{{ number_format($payment->amount) }}</td>
            <td>
              <span class="badge bg-{{ 
                $payment->status == 'Paid' ? 'success' : 
                ($payment->status == 'Pending' ? 'warning' : 
                ($payment->status == 'Failed' ? 'danger' : 'secondary')) }}">
                {{ $payment->status }}
              </span>
            </td>
            <td>{{ $payment->method }}</td>
            <td>{{ $payment->payment_date->format('Y-m-d') }}</td>
            <td class="d-flex justify-content-center gap-2">
              <button class="btn btn-sm btn-outline-info" data-bs-toggle="modal"
                data-bs-target="#viewPaymentModal" data-id="{{ $payment->id }}">📝 View</button>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  
    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-3">
      {{ $payments->links('pagination::bootstrap-5') }}
    </div>
  
  </div>
  
  <!-- 5. Payment Detail Modal -->
  <div class="modal fade" id="viewPaymentModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">📝 Payment Details</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <!-- Dynamic content load via JS or Livewire -->
          <p>Loading payment details...</p>
        </div>
      </div>
    </div>
  </div>
  
  @endsection
  
  @push('scripts')
  @endpush  