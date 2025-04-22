@extends('layouts.app')
@section('content')
<div class="card p-4">
    <h2>🛒 Booking Checkout</h2>
    <p><strong>Room:</strong> {{ $room->room_title }}</p>
    <p><strong>Amount:</strong> ₹{{ $room->room_price }}</p>

    <form method="POST" action="{{ route('user.booking.pay', $room->room_id) }}">
        @csrf
        <button type="submit" class="btn btn-success">💳 Pay Now (Dummy)</button>
    </form>
</div>
@endsection
