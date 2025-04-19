@extends('layouts.admin')
@section('title', 'Manage Users')
@push('styles')
    <style>
        .badge-verified {
            background-color: #28a745;
        }

        .badge-notverified {
            background-color: #dc3545;
        }

        .badge-active {
            background-color: #17a2b8;
        }

        .badge-blocked {
            background-color: #ffc107;
        }

        .btn-group {
            gap: 8px;
            /* Adjust the gap as per your requirement */
        }
    </style>
@endpush

@section('content')

    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4>👥 User Listing</h4>
            <button class="btn btn-success">📤 Export</button>
        </div>

        <!-- Filters -->
        <div class="card p-3 mb-4">
            <div class="row g-2">
                <div class="col-md-3">
                    <input type="text" class="form-control" placeholder="Search Name, Email, Username">
                </div>
                <div class="col-md-2">
                    <select class="form-control">
                        <option value="">Role</option>
                        <option>User</option>
                        <option>Room Owner</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <input type="text" class="form-control" placeholder="City">
                </div>
                <div class="col-md-2">
                    <select class="form-control">
                        <option>Verification</option>
                        <option>Verified</option>
                        <option>Not Verified</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select class="form-control">
                        <option>Account Status</option>
                        <option>Active</option>
                        <option>Blocked</option>
                    </select>
                </div>
                <div class="col-md-1">
                    <button class="btn btn-primary w-100">🔍</button>
                </div>
            </div>
        </div>

        <!-- User Table -->
        <div class="card">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="thead-light">
                        <tr>
                            <th>User ID</th>
                            <th>Name</th>

                            <th>Email</th>
                            <th>Phone</th>
                            <th>Role</th>
                            <th>City</th>
                            <th>Verification</th>
                            <th>Status</th>
                            <th>Registered</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr></tr>
                            <td>#{{ $user->user_id }}</td>
                            <td>{{ $user->full_name }}</td>

                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone ?? 'N/A' }}</td>
                            <td><span
                                    class="badge badge-{{ $user->role == 'user' ? 'primary' : 'secondary' }}">{{ $user->role }}</span>
                            </td>
                            <td>{{ $user->profile->city ?? 'N/A' }}</td>
                            <td><span
                                    class="badge badge-{{ $user->is_verified ? 'verified' : 'notverified' }}">{{ $user->is_verified ? 'Verified' : 'Not Verified' }}</span>
                            </td>
                            <td><span
                                    class="badge badge-{{ $user->is_blocked ? 'blocked' : 'active' }}">{{ $user->is_blocked ? 'Blocked' : 'Active' }}</span>
                            </td>
                            <td>{{ $user->created_at }}</td>
                            <td class="d-flex g-10 justify-content-evenly align-items-center flex-wrap">
                                <button class="btn btn-sm btn-outline-info mx-1 mb-2" data-toggle="modal"
                                    data-target="#viewUserModal" data-id="{{ $user->user_id }}">👁️</button>

                                <button class="btn btn-sm btn-outline-warning mx-1 mb-2" data-toggle="modal"
                                    data-target="#blockUserModal" data-id="{{ $user->user_id }}">🚫</button>
                                <button class="btn btn-sm btn-outline-success mx-1 mb-2" data-toggle="modal"
                                    data-target="#unblockUserModal" data-id="{{ $user->user_id }}"
                                    data-name="{{ $user->full_name }}">✅</button>
                                <button class="btn btn-sm btn-outline-danger mx-1 mb-2" data-toggle="modal"
                                    data-target="#deleteUserModal" data-id="{{ $user->user_id }}">🗑️</button>
                            </td>

                            </tr>

                        @empty
                            <tr>
                                <td colspan="11" class="text-center text-muted">No Users found.</td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
                <div class="p-3">
                    {{ $users->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>

    <!-- User Profile Modal -->
    <div class="modal fade" id="viewUserModal" tabindex="-1" aria-labelledby="viewUserModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="viewUserModalLabel">👤 User Profile</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span>&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <h6 class="mb-2">📄 Basic Information</h6>
                    <!-- Inside your modal body -->
                    <div class="row">
                        <div class="col-md-6"><strong>Full Name:</strong> <span id="userFullName">--</span></div>
                        <div class="col-md-6"><strong>Email:</strong> <span id="userEmail">--</span></div>
                        <div class="col-md-6"><strong>Phone:</strong> <span id="userPhone">--</span></div>
                        <div class="col-md-6"><strong>Role:</strong> <span id="userRole">--</span></div>
                        <div class="col-md-6"><strong>City:</strong> <span id="userCity">--</span></div>
                        <div class="col-md-6"><strong>Registered On:</strong> <span id="userRegistered">--</span></div>
                    </div>

                    <!-- Verification Badges -->
                    <ul class="list-group list-group-sm mb-3">
                        <li class="list-group-item">📧 Email: <span id="emailVerifyBadge" class="badge">--</span></li>
                        <li class="list-group-item">📱 Phone: <span id="phoneVerifyBadge" class="badge">--</span></li>
                        <li class="list-group-item">🆔 Aadhar / ID: <span id="aadharVerifyBadge" class="badge">--</span>
                        </li>
                    </ul>

                    <!-- Documents -->
                    <ul class="list-group">
                        <li class="list-group-item">
                            Aadhar Card:
                            <a id="aadharLink" href="#" class="btn btn-sm btn-outline-info ml-2"
                                target="_blank">View</a>
                        </li>
                        <li class="list-group-item">
                            College ID / Passbook:
                            <a id="idCardLink" href="#" class="btn btn-sm btn-outline-info ml-2"
                                target="_blank">View</a>
                        </li>
                    </ul>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">✏️ Edit User</button>
                    <button type="button" class="btn btn-danger">🚫 Block</button>
                </div>
            </div>
        </div>
    </div>



    <!-- Block User Modal -->
    <div class="modal fade" id="blockUserModal" tabindex="-1" aria-labelledby="blockUserModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="blockUserModalLabel">🚫 Block User</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span>&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <p class="mb-3">
                        Are you sure you want to block <strong id="blockUserName">John Doe</strong>? This will restrict
                        their access to the platform.
                    </p>

                    <div class="form-group">
                        <label for="blockReason">Reason for blocking <small class="text-muted">(optional)</small></label>
                        <textarea id="blockReason" class="form-control" rows="3" placeholder="Enter reason (optional)..."></textarea>
                    </div>
                    <div class="alert alert-warning mt-3 mb-0">
                        ⚠️ You can unblock the user later from the user details section.
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">✅ Confirm Block</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <!-- unblockUserModal User Modal -->
    <div class="modal fade" id="unblockUserModal" tabindex="-1" aria-labelledby="unblockUserModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="unblockUserModalLabel">✅ Unblock User</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span>&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <p class="mb-3">
                        Are you sure you want to unblock <strong id="unblockUserName">John Doe</strong>?
                    </p>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">✅ Confirm Unblock</button>
                </div>
            </form>
        </div>
    </div>


    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteUserModal" tabindex="-1" aria-labelledby="deleteUserModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">Confirm Deletion</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" aria-hidden="true">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this user?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger">Delete</button>
                </div>
            </div>
        </div>
    </div>


@endsection
@push('scripts')
    <!-- Bootstrap 5 Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('[data-target="#viewUserModal"]').forEach(button => {
                button.addEventListener('click', function() {
                    const userId = this.getAttribute('data-id');

                    fetch(`/admin/users/${userId}`)
                        .then(response => response.json())
                        .then(data => {
                            console.log(data);
                            const user = data;
                            const profile = user.user_profile || {};

                            // Inject data into modal using IDs
                            document.getElementById('userFullName').textContent = user
                                .full_name || 'Not Available';

                            document.getElementById('userEmail').textContent = user.email ||
                                'Not Available';
                            document.getElementById('userPhone').textContent = user.phone ||
                                'Not Available';
                            const role = user.role === 'user' ? 'User' : 'Owner' ||
                                'Not Available';
                            document.getElementById('userRole').textContent = role;
                            const city = user.profile?.city || user.owner_profile?.city ||
                                'Not Available';
                            document.getElementById('userCity').textContent = city;


                            document.getElementById('userRegistered').textContent = new Date(
                                user.created_at).toLocaleDateString();

                            // Verification badges
                            const emailBadge = document.getElementById('emailVerifyBadge');
                            emailBadge.textContent = user.is_verified ? 'Verified' :
                                'Unverified';
                            emailBadge.className =
                                `badge badge-${user.is_verified ? 'success' : 'warning'}`;

                            const phoneBadge = document.getElementById('phoneVerifyBadge');
                            phoneBadge.textContent = user.phone ? 'Verified' : 'Unverified';
                            phoneBadge.className =
                                `badge badge-${user.phone ? 'success' : 'warning'}`;

                            const aadharBadge = document.getElementById('aadharVerifyBadge');
                            aadharBadge.textContent = profile.aadhar ? 'Verified' : 'Pending';
                            aadharBadge.className =
                                `badge badge-${profile.aadhar ? 'success' : 'warning'}`;

                            // Document links
                            document.getElementById('aadharLink').href = profile.aadhar_url ||
                                'Not Available';
                            document.getElementById('idCardLink').href = profile.id_card_url ||
                                'Not Available';

                            // Show modal
                            const modal = new bootstrap.Modal(document.getElementById(
                                'viewUserModal'));
                            modal.show();
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('❌ Failed to load user details.');
                        });
                });
            });
        });
        document.addEventListener('DOMContentLoaded', function() {
            // Show modal and pass user info
            document.querySelectorAll('[data-target="#blockUserModal"]').forEach(button => {
                button.addEventListener('click', function() {
                    const userId = this.getAttribute('data-id');
                    const userName = this.getAttribute('data-name') || 'User';

                    // Set modal data
                    document.getElementById('blockUserModal').setAttribute('data-user-id', userId);
                    document.querySelector('#blockUserModal .modal-body strong').textContent =
                        userName;

                    // Show modal
                    const modal = new bootstrap.Modal(document.getElementById('blockUserModal'));
                    modal.show();
                });
            });

            // Handle form submission
            document.querySelector('#blockUserModal form').addEventListener('submit', function(e) {
                e.preventDefault();

                const userId = document.getElementById('blockUserModal').getAttribute('data-user-id');
                const reason = document.getElementById('blockReason').value;

                fetch(`/admin/users/${userId}/block`, {
                        method: 'PATCH',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            reason: reason
                        })
                    })
                    .then(response => {
                        if (!response.ok) throw new Error('Block failed');
                        return response.json();
                    })
                    .then(data => {
                        alert('User blocked successfully.');
                        $('#blockUserModal').modal('hide');
                    })
                    .catch(error => {
                        console.error(error);
                        alert('Failed to block user.');
                    });
            });
        });
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('[data-target="#unblockUserModal"]').forEach(button => {
                button.addEventListener('click', function() {
                    const userId = this.getAttribute('data-id');
                    const userName = this.getAttribute('data-name'); // Get the user's name

                    // Update the modal content dynamically
                    document.getElementById('unblockUserName').textContent = userName;

                    // On confirm unblock, trigger the API call
                    const unblockButton = document.querySelector('#unblockUserModal .btn-success');
                    unblockButton.addEventListener('click', function() {
                        fetch(`/admin/users/${userId}/unblock`, {
                                method: 'PATCH',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                }
                            })
                            .then(response => {
                                if (!response.ok) throw new Error('Unblock failed');
                                return response.json();
                            })
                            .then(data => {
                                alert('User unblocked successfully.');
                                $('#unblockUserModal').modal('hide');
                            })
                            .catch(error => {
                                console.error(error);
                                alert('Failed to unblock user.');
                            });
                    });
                });
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            let deleteButton = document.querySelector('#deleteUserModal .btn-danger');

            document.querySelectorAll('[data-target="#deleteUserModal"]').forEach(button => {
                button.addEventListener('click', function() {
                    const userId = this.getAttribute('data-id');
                    const userName = this.getAttribute('data-name') || 'this user';

                    // Update modal content
                    document.querySelector('#deleteUserModal .modal-body').textContent =
                        `Are you sure you want to delete ${userName}?`;

                    // Replace old listener
                    const newButton = deleteButton.cloneNode(true);
                    deleteButton.parentNode.replaceChild(newButton, deleteButton);
                    deleteButton = newButton;

                    // Add fresh click event
                    deleteButton.addEventListener('click', function() {
                        fetch(`/admin/users/${userId}`, {
                                method: 'DELETE',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                }
                            })
                            .then(response => {
                                if (!response.ok) throw new Error('Delete failed');
                                return response.json();
                            })
                            .then(data => {
                                $('#deleteUserModal').modal('hide');
                                alert('✅ User deleted successfully.');
                                location.reload(); // Optionally reload to update list
                            })
                            .catch(error => {
                                console.error(error);
                                alert('❌ Failed to delete user.');
                            });
                    });
                });
            });
        });
    </script>
@endpush
