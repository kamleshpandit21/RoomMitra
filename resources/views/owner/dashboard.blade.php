@extends('layouts.owner')
@section('title', 'Dashboard')

@section('content')
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card shadow-sm text-center p-3">
                <h6>Total Rooms</h6>
                @if ($rooms->isEmpty())
                    <h3>0</h3>
                    <small>No rooms found</small>
                @else
                    <h3>{{ $rooms->count() }}</h3>
                    <small>You have {{ $rooms->count() }} active rooms</small>
                @endif

            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm text-center p-3">
                <h6>Total Bookings</h6>
                <h3>0</h3>
                <small>0 bookings received</small>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm text-center p-3">
                <h6>Total Earnings</h6>
                <h3>₹85,000</h3>
                <small>This month</small>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm text-center p-3">
                <h6>Pending Complaints</h6>
                <h3>3</h3>
                <small>Unresolved complaints</small>
            </div>
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5>📊 Bookings Overview</h5>
            <select class="form-select w-auto" id="bookingRangeSelector">
                <option value="7">Last 7 days</option>
                <option value="30">Last 30 days</option>
            </select>
        </div>
        <div class="card-body">

            <!-- Chart Canvas -->
            <canvas id="bookingsChart" height="120"></canvas>

            <!-- Booking Table -->
            <div class="table-responsive mt-4">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Booking ID</th>
                            <th>Room</th>
                            <th>User</th>
                            <th>Check-in / out</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>#BK1012</td>
                            <td>Studio Apartment A</td>
                            <td>Ankit Joshi</td>
                            <td>12 Apr – 15 Apr</td>
                            <td><span class="badge bg-success">Confirmed</span></td>
                        </tr>
                        <!-- more rows -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <h5>🏨 Latest Rooms Added</h5>
        </div>
        <div class="card-body">
            <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Single Room AC – ₹4,500
                    <span class="badge bg-info">Available</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Double Room – ₹6,000
                    <span class="badge bg-warning">Booked</span>
                </li>
                <!-- more -->
            </ul>
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-header">
            <h5>💬 Recent Complaints / Messages</h5>
        </div>
        <div class="card-body">
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <strong>“Room AC not working”</strong><br>
                    <small>by Rakesh (User)</small> – <a href="#">View</a>
                </li>
                <!-- more -->
            </ul>
        </div>
    </div>
    <div class="d-flex flex-wrap justify-content-between gap-2 my-4">
        <a href="{{ route('owner.rooms.create') }}" class="btn btn-primary">➕ Add New Room</a>
        <a href="{{ route('owner.bookings.index') }}" class="btn btn-outline-dark">📁 View All Bookings</a>
        <a href="/earnings" class="btn btn-outline-success">💰 Check Earnings</a>
        <a href="/profile" class="btn btn-outline-secondary">⚙️ Update Profile</a>
    </div>
@endsection
@push('scripts')
    <!-- Include Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('bookingsChart').getContext('2d');

        const generateDummyData = (days) => {
            const labels = [];
            const data = [];
            for (let i = days; i >= 1; i--) {
                const date = new Date();
                date.setDate(date.getDate() - i);
                labels.push(date.toLocaleDateString('en-IN', {
                    day: 'numeric',
                    month: 'short'
                }));
                data.push(Math.floor(Math.random() * 10 + 1)); // random bookings count
            }
            return {
                labels,
                data
            };
        };

        let currentDays = 7;
        let {
            labels,
            data
        } = generateDummyData(currentDays);

        let bookingsChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Bookings',
                    data: data,
                    borderColor: '#0d6efd',
                    backgroundColor: 'rgba(13, 110, 253, 0.1)',
                    tension: 0.3,
                    fill: true,
                    pointRadius: 4,
                    pointHoverRadius: 6
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Handle dropdown change
        document.getElementById('bookingRangeSelector').addEventListener('change', function() {
            const days = parseInt(this.value);
            const newData = generateDummyData(days);
            bookingsChart.data.labels = newData.labels;
            bookingsChart.data.datasets[0].data = newData.data;
            bookingsChart.update();
        });
    </script>
@endpush
