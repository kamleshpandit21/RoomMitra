@extends('layouts.admin')
@section('title', 'Manage Complaints')
@push('styles')
@endpush

@section('content')

    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card bg-light shadow-sm text-center p-3">
                <h6>Total Complaints</h6>
                <h4>{{ $total ?? 0 }}</h4>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-info text-white text-center p-3">
                <h6>In Progress</h6>
                <h4>{{ $inprogress ?? 0 }}</h4>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-danger text-white text-center p-3">
                <h6>Pending</h6>
                <h4>{{ $pending ?? 0 }}</h4>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success text-white text-center p-3">
                <h6>Resolved</h6>
                <h4>{{ $resolved ?? 0 }}</h4>
            </div>
        </div>

    </div>
    <div class="row mb-3">
        <div class="col-md-3">
            <input type="text" class="form-control" placeholder="Search by keyword or Room ID">
        </div>
        <div class="col-md-2 form-group">
            <select class="form-control form-select">
                <option value="">Status</option>
                <option>Open</option>
                <option>In Progress</option>
                <option>Resolved</option>
                <option>Closed</option>
            </select>
        </div>
        <div class="col-md-2">
            <input type="text" class="form-control" placeholder="User/Owner Name">
        </div>
        <div class="col-md-3">
            <input type="date" class="form-control" placeholder="Date From">
        </div>
        <div class="col-md-2">
            <button class="btn btn-primary w-100">🔍 Filter</button>
        </div>
    </div>
    <div class="dropdown mb-3">
        <button class="btn btn-outline-dark dropdown-toggle" data-toggle="dropdown">📤 Export</button>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Export as CSV</a></li>
            <li><a class="dropdown-item" href="#">Export as PDF</a></li>
        </ul>
    </div>

    <table class="table table-hover align-middle">
        <thead class="thead-light">
            <tr>
                <th>ID</th>
                <th>From</th>
                <th>Category</th>
                <th>Subject</th>
                <th>Status</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($complaints as $complaint)
                <tr>
                    <td>{{ $complaint->id }}</td>
                    <td>
                        <strong>{{ $complaint->name }}</strong><br>
                        <small>{{ $complaint->email }}</small><br>
                        <span
                            class="badge {{ $complaint->user_type == 'Owner' ? 'bg-success text-dark' : 'bg-info text-dark' }}">{{ $complaint->user_type }}</span>
                    </td>
                    <td>{{ $complaint->category }}</td>
                    <td>{{ $complaint->subject }}</td>
                    <td>
                        <span
                            class="badge bg-{{ $complaint->status == 'pending' ? 'warning' : ($complaint->status == 'in_progress' ? 'info' : ($complaint->status == 'resolved' ? 'success' : 'secondary')) }}">
                            {{ ucwords($complaint->status) }}
                        </span>
                    </td>
                    <td>{{ $complaint->created_at }}</td>
                    <td>
                        <button class="btn btn-sm btn-outline-info view-complaint-btn" data-toggle="modal"
                            data-target="#viewComplaintModal" data-id="{{ $complaint->id }}">👁️</button>

                        <button class="btn btn-sm btn-outline-danger delete-complaint-btn" data-id="{{ $complaint->id }}"
                            data-url="{{ route('admin.complaints.destroy', $complaint->id) }}">🗑️</button>
                    </td>
                </tr>

            @empty
                <tr>
                    <td colspan="7" class="text-center">No Complaints Found</td>
                </tr>
            @endforelse

        </tbody>
    </table>

    <div class="modal fade" id="viewComplaintModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Complaint #<span class="modal-complaint-id"></span></h5>
                    <button type="button" class="close" data-dismiss="modal"><i class="fas fa-times"></i></button>
                </div>
                <div class="modal-body">
                    <h5>Complaint #<span id="modalComplaintId" class="modal-complaint-id"></span></h5>

                    <h6>Subject: <span id="modalSubject"></span></h6>
                    <p><strong>Description:</strong> <span id="modalDescription"></span></p>

                    <hr>
                    <h6>User Info</h6>
                    <p>
                        Name: <span id="modalName"></span><br>
                        Email: <span id="modalEmail"></span><br>
                        Role: <span id="modalRole"></span>
                    </p>



                    <h6>Attachments:</h6>
                    <a href="#" target="_blank" id="modalAttachment">No attachment</a>

                </div>
                <hr>
                <div class="modal-footer">
                    <h6 class="text-align-start">Reply / Notes</h6>
                    <textarea class="form-control mb-2" placeholder="Write your reply or note..."></textarea>
                   
                    <div class="row justify-content-between">
                        <button class="btn btn-success">💬 Send Reply</button>
                        <button class="btn btn-outline-secondary resolve-modal-btn">
                            ✅ Mark as Resolved
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        //view complaint details
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.view-complaint-btn').forEach(btn => {
                btn.addEventListener('click', () => {
                    const complaintId = btn.getAttribute('data-id');
                    const url = '{{ route('admin.complaints.show', ':id') }}'.replace(':id',
                        complaintId);
                    console.log(url);
                    fetch(url)
                        .then(response => response.json())
                        .then(data => {
                            console.log(data);
                            const modalComplaintId = document.querySelectorAll(
                                '.modal-complaint-id')
                            modalComplaintId.forEach(element => {
                                element.textContent = data.id
                            })
                            document.getElementById('modalSubject').textContent = data
                                .subject;
                            document.getElementById('modalDescription').textContent = data
                                .description;
                            document.getElementById('modalName').textContent = data.name;
                            document.getElementById('modalEmail').textContent = data.email;
                            document.getElementById('modalRole').textContent = data.user_type;


                            // Show the modal (Bootstrap 5 method)
                            var myModal = new bootstrap.Modal(document.getElementById(
                                'viewComplaintModal'));
                            myModal.show();
                        })
                        .catch(error => {
                            console.error('Error fetching complaint details:', error);
                            alert('Unable to fetch complaint details.');
                        })
                })
            })
        })
        // document.addEventListener('DOMContentLoaded', () => {
        //     // Handle click on "Mark as Resolved" in modal
        //     document.querySelectorAll('.resolve-modal-btn').forEach(btn => {
        //         btn.addEventListener('click', async () => {
        //             const url = btn.getAttribute('data-url');

        //             if (!url) {
        //                 alert("No URL found to resolve the complaint.");
        //                 return;
        //             }

        //             if (confirm(
        //                     'Are you sure you want to mark this complaint as resolved?'
        //                     )) {
        //                 try {
        //                     const response = await fetch(url, {
        //                         method: 'POST',
        //                         headers: {
        //                             'X-CSRF-TOKEN': '{{ csrf_token() }}',
        //                             'Accept': 'application/json'
        //                         }
        //                     });

        //                     const data = await response.json();

        //                     if (response.ok) {
        //                         alert(data.message ||
        //                             'Marked as resolved!');
        //                         // Optionally close modal
        //                         $('#viewComplaintModal').modal('hide');
        //                         location
        //                     .reload(); // Reload to reflect change
        //                     } else {
        //                         alert(data.message ||
        //                             'Failed to resolve.');
        //                     }
        //                 } catch (error) {
        //                     console.error(error);
        //                     alert(
        //                         'Something went wrong while resolving the complaint.');
        //                 }
        //             }
        //         });
        //     });
        // });

        // delete complaint
        document.querySelectorAll('.delete-complaint-btn').forEach(button => {
            button.addEventListener('click', function() {
                let complaintId = this.getAttribute('data-id');

                if (confirm('Are you sure you want to delete this complaint?')) {
                    fetch(`/admin/complaints/${complaintId}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json',
                            }
                        })
                        .then(response => {
                            if (response.ok) {
                                // Optionally refresh the page or remove the row
                                location.reload();
                            } else {
                                alert('Failed to delete complaint.');
                            }
                        })
                        .catch(error => {
                            console.error('Delete error:', error);
                            alert(
                                'Something went wrong while deleting the complaint.');
                        })
                }
            })
        })
    </script>
@endpush
