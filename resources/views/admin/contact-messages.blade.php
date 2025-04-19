@extends('admin.layout.master')


@section('title', 'Support Requests')
@push('styles')
    
@endpush

@section('content')
<h1 class="text-primary fw-bold">📞 Contact Requests</h1>

<div class="row">
    <!-- Filters -->
    <div class="col-12 mb-3">
        <div class="card p-3">
            <div class="row g-2">
                <div class="col-md-3">
                    <input type="text" class="form-control" placeholder="Search by Name, Email, or Ticket ID">
                </div>
                <div class="col-md-2">

                    <div class="form-group">
                        <select class="form-control select2">
                            <option value="">Category</option>
                            <option>Room Booking</option>
                            <option>Payment</option>
                            <option>Complaint</option>
                            <option>Technical</option>
                        </select>
                      </div>
                    
                </div>
                <div class="col-md-2">
                   <div class="form-group">
                    <select class="form-control select2">
                        <option value="">Status</option>
                        <option>New</option>
                        <option>In Progress</option>
                        <option>Resolved</option>
                    </select>
                   </div>
                </div>
                <div class="col-md-3">
                    <input type="date" class="form-control">
                </div>
                <div class="col-md-2">
                    <button class="btn btn-primary w-100">Filter</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Support Requests Table -->
    <div class="col-12">
        <div class="card">
            <div class="card-body table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>🆔</th>
                            <th>👤 Name</th>
                            <th>📧 Contact Info</th>
                            <th>🔖 User Type</th>
                            <th>📂 Category</th>
                            <th>📝 Subject</th>
                            <th>📅 Submitted At</th>
                            <th>🔁 Status</th>
                            <th>👤 Assigned To</th>
                            <th>⚙️ Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>#REQ-00001</td>
                            <td>John Doe</td>
                            <td>john@example.com</td>
                            <td><span class="badge bg-info text-dark">Tenant</span></td>
                            <td>Room Booking</td>
                            <td>Need help with reservation</td>
                            <td>10 Apr, 2025 02:15 PM</td>
                            <td><span class="badge bg-primary">New</span></td>
                            <td>Support Team</td>
                            <td>
                                <a href="#" class="btn btn-sm btn-outline-info">View</a>
                                <button class="btn btn-sm btn-outline-success">Resolve</button>
                                <button class="btn btn-sm btn-outline-danger">Delete</button>
                            </td>
                        </tr>
                        <!-- Repeat this row as needed -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Dashboard Widgets -->
<div class="row mt-4">
    <div class="col-md-3">
        <div class="small-box bg-primary">
            <div class="inner">
                <h3>4</h3>
                <p>New Support Requests Today</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>12</h3>
                <p>Pending Responses</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>20</h3>
                <p>Resolved This Week</p>
            </div>
        </div>
    </div>
</div>

@endsection

@push('css')
<style>
    table td, table th {
        vertical-align: middle !important;
    }
    .small-box .inner h3 {
        font-size: 28px;
        font-weight: bold;
    }
</style>
@endpush
