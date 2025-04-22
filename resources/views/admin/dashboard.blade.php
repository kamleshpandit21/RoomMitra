@extends('layouts.admin')
@section('title', 'Admin Dashboard')


@section('content')
   <!-- Content Wrapper. Contains page content -->

    <!-- Page Title -->
    <section class="content-header">
      <h1 class="mb-4 fw-bold">📊 Admin Dashboard</h1>
    </section>
  
    <!-- Summary Cards -->
    <div class="row">
      <div class="col-md-3 col-sm-6 mb-3">
        <div class="small-box bg-info">
          <div class="inner">
            <h3>{{ $total_users ?? 0 }}</h3>
            <p>Total Users</p>
          </div>
          <div class="icon">
            <i class="fas fa-users"></i>
          </div>
          <a href="#" class="small-box-footer">View Users <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
  
      <div class="col-md-3 col-sm-6 mb-3">
        <div class="small-box bg-primary">
          <div class="inner">
            <h3>{{$total_owners ?? 0}}</h3>
            <p>Total Room Owners</p>
          </div>
          <div class="icon">
            <i class="fas fa-user-tie"></i>
          </div>
          <a href="#" class="small-box-footer">View Owners <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
  
      <div class="col-md-3 col-sm-6 mb-3">
        <div class="small-box bg-success">
          <div class="inner">
            <h3>{{$total_rooms ?? 0}}</h3>
            <p>Total Rooms</p>
          </div>
          <div class="icon">
            <i class="fas fa-bed"></i>
          </div>
          <a href="#" class="small-box-footer">Manage Rooms <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
  
      <div class="col-md-3 col-sm-6 mb-3">
        <div class="small-box bg-warning">
          <div class="inner">
            <h3>{{$total_pending_rooms ?? 0}}</h3>
            <p>Pending Room Approvals</p>
          </div>
          <div class="icon">
            <i class="fas fa-hourglass-half"></i>
          </div>
          <a href="#" class="small-box-footer">Approve Now <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
    </div>
  
    <!-- Charts Section -->
    <div class="row">
      <div class="col-lg-6 mb-3">
        <div class="card">
          <div class="card-header">
            <h5>📅 Bookings Per Month</h5>
          </div>
          <div class="card-body">
            <canvas id="bookingsChart" height="200"></canvas>
          </div>
        </div>
      </div>
  
      <div class="col-lg-6 mb-3">
        <div class="card">
          <div class="card-header">
            <h5>💸 Revenue Trends</h5>
          </div>
          <div class="card-body">
            <canvas id="revenueChart" height="200"></canvas>
          </div>
        </div>
      </div>
    </div>
  
    <!-- Additional Charts -->
    <div class="row">
      <div class="col-lg-6 mb-3">
        <div class="card">
          <div class="card-header">
            <h5>🌍 City-wise Booking Distribution</h5>
          </div>
          <div class="card-body">
            <canvas id="cityChart" height="180"></canvas>
          </div>
        </div>
      </div>
  
      <div class="col-lg-6 mb-3">
        <div class="card">
          <div class="card-header">
            <h5>👥 User Growth</h5>
          </div>
          <div class="card-body">
            <canvas id="userChart" height="180"></canvas>
          </div>
        </div>
      </div>
    </div>
  
    <!-- Quick Actions -->
    <div class="row">
      <div class="col-lg-12 mb-4">
        <div class="card card-outline card-primary">
          <div class="card-header">
            <h5>⚙️ Quick Actions</h5>
          </div>
          <div class="card-body d-flex flex-wrap gap-3">
            <button class="btn btn-sm btn-success"><i class="fas fa-check-circle"></i> Approve Rooms</button>
            <button class="btn btn-sm btn-info"><i class="fas fa-comment-dots"></i> Respond to Complaints</button>
            <button class="btn btn-sm btn-warning"><i class="fas fa-clipboard-list"></i> Review Bookings</button>
            <button class="btn btn-sm btn-secondary"><i class="fas fa-credit-card"></i> Verify Payments</button>
            <button class="btn btn-sm btn-dark"><i class="fas fa-question-circle"></i> Add FAQ</button>
          </div>
        </div>
      </div>
    </div>
  
    <!-- Notifications & Recent Activity -->
    <div class="row">
      <div class="col-lg-6 mb-3">
        <div class="card">
          <div class="card-header bg-danger text-white">
            <h5 class="mb-0">🔔 Notifications</h5>
          </div>
          <div class="card-body">
            <ul class="list-unstyled">
              <li>⚠️ <strong>Pending Room Approvals:</strong> 24</li>
              <li>📬 <strong>New Complaints:</strong> 8</li>
              <li>💰 <strong>Payment Issues:</strong> 3</li>
              <li>🆕 <strong>New User Registered:</strong> John Doe</li>
            </ul>
          </div>
        </div>
      </div>
  
      <div class="col-lg-6 mb-3">
        <div class="card">
          <div class="card-header bg-secondary text-white">
            <h5 class="mb-0">📅 Recent Activity</h5>
          </div>
          <div class="card-body">
            <ul class="list-group list-group-flush">
              <li class="list-group-item">New Booking by Aman Gupta</li>
              <li class="list-group-item">New Room listed by Rahul</li>
              <li class="list-group-item">Complaint resolved by Admin</li>
              <li class="list-group-item">Payment released to Owner #102</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  
    <!-- Support Requests Table -->
    <div class="card mt-3">
      <div class="card-header">
        <h5>📥 Recent Support Requests</h5>
      </div>
      <div class="card-body">
        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Ticket ID</th>
              <th>User</th>
              <th>Contact</th>
              <th>Category</th>
              <th>Submitted</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>#REQ-01234</td>
              <td>Arjun</td>
              <td>arjun@example.com</td>
              <td>Room Booking</td>
              <td>2025-04-10</td>
              <td><span class="badge badge-warning">New</span></td>
            </tr>
          </tbody>
        </table>
        <a href="#" class="btn btn-primary btn-sm mt-2">View All Requests</a>
      </div>
    </div>
    
@endsection
