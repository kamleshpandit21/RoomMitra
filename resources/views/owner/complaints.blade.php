@extends('layouts.owner')
@section('title', 'Complaints')

@section('content')
    <div class="container my-4">

        <!-- 1. Page Title -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3>📖 Manage Complaints</h3>
        </div>

        <!-- 2. Summary Widgets -->
        <div class="row g-3 mb-4">
            <div class="col-md-3">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h6 class="text-muted">✅ Total Complaints</h6>
                        <h4>{{ $totalComplaints }}</h4>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h6 class="text-muted">🔴 Complaints Pending Resolution</h6>
                        <h4>{{ $pendingComplaints }}</h4>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h6 class="text-muted">🟢 Complaints Resolved</h6>
                        <h4>{{ $resolvedComplaints }}</h4>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h6 class="text-muted">🛠️ Complaints In Progress</h6>
                        <h4>{{ $inProgressComplaints }}</h4>
                    </div>
                </div>
            </div>
        </div>

        <!-- 3. Filters -->
        <form method="GET" class="row g-2 mb-3">
            <div class="col-md-3">
                <input type="text" class="form-control" name="complaint_id" placeholder="🔍 Complaint ID">
            </div>
            <div class="col-md-3">
                <input type="text" class="form-control" name="user_name" placeholder="User Name / Email">
            </div>
            <div class="col-md-2">
                <select class="form-select" name="complaint_status">
                    <option value="">All Status</option>
                    <option value="Pending">Pending</option>
                    <option value="In Progress">In Progress</option>
                    <option value="Resolved">Resolved</option>
                    <option value="Closed">Closed</option>
                </select>
            </div>
            <div class="col-md-2">
                <select class="form-select" name="complaint_type">
                    <option value="">All Types</option>
                    <option value="Noise">Noise</option>
                    <option value="Cleanliness">Cleanliness</option>
                    <option value="Maintenance">Maintenance</option>
                    <option value="Other">Other</option>
                </select>
            </div>
            <div class="col-md-2">
                <input type="date" name="from_date" class="form-control" placeholder="From Date">
            </div>
            <div class="col-md-2">
                <input type="date" name="to_date" class="form-control" placeholder="To Date">
            </div>
        </form>

        <!-- 4. Complaints Table -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle text-center">
                <thead class="table-light">
                    <tr>
                        <th>Complaint ID</th>
                        <th>User Name</th>
                        <th>Complaint Type</th>
                        <th>Status</th>
                        <th>Date Filed</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($complaints as $complaint)
                        <tr>
                            <td>#{{ $complaint->id }}</td>
                            <td>
                                <a
                                    href="{{ route('owner.users.show', $complaint->user_id) }}">{{ $complaint->user->name }}</a>
                            </td>
                            <td>{{ $complaint->type }}</td>
                            <td>
                                <span
                                    class="badge bg-{{ $complaint->status == 'Pending'
                                        ? 'warning'
                                        : ($complaint->status == 'In Progress'
                                            ? 'info'
                                            : ($complaint->status == 'Resolved'
                                                ? 'success'
                                                : 'secondary')) }}">
                                    {{ $complaint->status }}
                                </span>
                            </td>
                            <td>{{ $complaint->created_at->format('Y-m-d') }}</td>
                            <td class="d-flex justify-content-center gap-2">
                                <button class="btn btn-sm btn-outline-info" data-bs-toggle="modal"
                                    data-bs-target="#viewComplaintModal" data-id="{{ $complaint->id }}">📝 View</button>
                                <button class="btn btn-sm btn-outline-success" data-bs-toggle="modal"
                                    data-bs-target="#closeComplaintModal" data-id="{{ $complaint->id }}">🔒 Close</button>
                                <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal"
                                    data-bs-target="#reopenComplaintModal" data-id="{{ $complaint->id }}">🔄
                                    Reopen</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-3">
            {{ $complaints->links('pagination::bootstrap-5') }}
        </div>

    </div>

    <!-- 5. Complaint Detail Modal -->
    <div class="modal fade" id="viewComplaintModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">📝 Complaint Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Loading complaint details...</p>
                </div>
            </div>
        </div>
    </div>

    <!-- 6. Close Complaint Modal -->
    <div class="modal fade" id="closeComplaintModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">🔒 Close Complaint</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to close this complaint?</p>
                    <button type="button" class="btn btn-success">Yes, Close</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <!-- 7. Reopen Complaint Modal -->
    <div class="modal fade" id="reopenComplaintModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">🔄 Reopen Complaint</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to reopen this complaint?</p>
                    <button type="button" class="btn btn-danger">Yes, Reopen</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')    
@endsection
