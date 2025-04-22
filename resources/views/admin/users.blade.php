@extends('layouts.admin')
@section('title', 'Manage Users')
@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

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
                            <tr>
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
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="viewUserModalLabel">👤 User Profile</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span>&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <!-- Profile Header -->
                    <div class="d-flex align-items-center mb-4">
                        <img id="userAvatar" src="https://via.placeholder.com/100" alt="User Avatar"
                            class="rounded-circle mr-3" style="width: 100px; height: 100px; object-fit: cover;">
                        <div>
                            <h4 id="userFullName" class="mb-0">--</h4>
                            <p class="mb-1 text-muted" id="userEmail">--</p>
                            <span class="badge badge-secondary" id="userRole">--</span>
                            <span class="ml-2 badge badge-success" id="userStatus">Verified</span>
                        </div>
                    </div>

                    <!-- Section 1: Basic Info -->
                    <h6 class="mb-3">📄 Basic Information</h6>
                    <div class="row">
                        <div class="col-md-4"><strong>Phone:</strong> <span id="userPhone">--</span></div>
                        <div class="col-md-4"><strong>City:</strong> <span id="userCity">--</span></div>
                        <div class="col-md-4"><strong>Registered On:</strong> <span id="userRegistered">--</span></div>

                        <div class="col-md-4"><strong>DOB:</strong> <span id="userDOB">--</span></div>
                        <div class="col-md-4"><strong>Gender:</strong> <span id="userGender">--</span></div>
                        <div class="col-md-4"><strong>Provider:</strong> <span id="userProvider">--</span></div>
                    </div>

                    <!-- Section 2: Address -->
                    <h6 class="mt-4 mb-2">🏠 Address Details</h6>
                    <div class="row">
                        <div class="col-md-6"><strong>Current:</strong> <span id="currentAddress">--</span></div>
                        <div class="col-md-6"><strong>Permanent:</strong> <span id="permanentAddress">--</span></div>
                        <div class="col-md-4"><strong>Locality:</strong> <span id="userLocality">--</span></div>
                        <div class="col-md-4"><strong>State:</strong> <span id="userState">--</span></div>
                        <div class="col-md-4"><strong>Pincode:</strong> <span id="userPincode">--</span></div>
                    </div>

                    <!-- Section 3: Education -->
                    <h6 class="mt-4 mb-2">🎓 Education</h6>
                    <div class="row">
                        <div class="col-md-4"><strong>College:</strong> <span id="collegeName">--</span></div>
                        <div class="col-md-4"><strong>Course:</strong> <span id="courseName">--</span></div>
                        <div class="col-md-4"><strong>Year:</strong> <span id="studyYear">--</span></div>
                    </div>

                    <!-- Section 4: Socials & Bio -->
                    <h6 class="mt-4 mb-2">🔗 Social & Bio</h6>
                    <p id="userBio" class="mb-2">--</p>
                    <div id="socialLinks">
                        <!-- Dynamically render social icons/links here -->
                    </div>

                    <!-- Section 5: Verification Badges -->
                    <h6 class="mt-4 mb-2">✅ Verification Status</h6>
                    <div class="row">
                        <div class="col-md-4">📧 Email: <span id="emailVerifyBadge"
                                class="badge badge-pill badge-secondary">--</span></div>
                        <div class="col-md-4">📱 Phone: <span id="phoneVerifyBadge"
                                class="badge badge-pill badge-secondary">--</span></div>
                        <div class="col-md-4">🆔 Aadhar: <span id="aadharVerifyBadge"
                                class="badge badge-pill badge-secondary">--</span></div>
                    </div>

                    <!-- Section 6: Documents -->
                    <h6 class="mt-4 mb-2">📎 Uploaded Documents</h6>
                    <ul class="list-group mb-2">
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

                <!-- Modal Footer -->
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


    <div class="modal fade" id="deleteUserModal" tabindex="-1" aria-labelledby="deleteUserModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">🗑️ Confirm Deletion</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span>&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <p>Are you sure you want to delete this user?</p>

                <div class="form-group">
                    <label for="deleteReason">Reason for Deletion <span class="text-danger">*</span></label>
                    <select id="deleteReason" class="form-control" required name="reason">
                        <option value="">-- Select Reason --</option>
                        <option value="fake_profile">Fake Profile</option>
                        <option value="abusive_behavior">Abusive Behavior</option>
                        <option value="violation">Policy Violation</option>
                        <option value="other">Other</option>
                    </select>
                </div>

                <div class="form-group mt-2">
                    <label for="deleteNote">Additional Notes (optional)</label>
                    <textarea id="deleteNote" class="form-control" rows="3" placeholder="Add a note..." name="note"></textarea>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Delete</button>
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
                    const user = data.user;
                    const profile = data.profile || {};

                    // Avatar
                    const avatarImg = document.getElementById('userAvatar');
                    avatarImg.src = profile.avatar ||
                        '{{ asset('img/avatar/avatar.png') }}';

                    // Basic Info
                    document.getElementById('userFullName').textContent = user
                        .full_name || 'N/A';
                    document.getElementById('userEmail').textContent = user.email ||
                        'N/A';
                    document.getElementById('userPhone').textContent = user.phone ||
                        'N/A';
                    document.getElementById('userRole').textContent = user.role ===
                        'room_owner' ? 'Room Owner' : 'User';
                    document.getElementById('userCity').textContent = profile.city ||
                        'N/A';
                    document.getElementById('userRegistered').textContent = new Date(
                        user.created_at).toLocaleDateString();

                    // More profile info
                    document.getElementById('userDOB').textContent = profile
                        .date_of_birth || 'N/A';
                    document.getElementById('userGender').textContent = profile
                        .gender || 'N/A';
                    document.getElementById('userProvider').textContent = user
                        .provider || 'Email';

                    document.getElementById('currentAddress').textContent = profile
                        .current_address || 'N/A';
                    document.getElementById('permanentAddress').textContent = profile
                        .permanent_address || 'N/A';
                    document.getElementById('userLocality').textContent = profile
                        .locality || 'N/A';
                    document.getElementById('userState').textContent = profile.state ||
                        'N/A';
                    document.getElementById('userPincode').textContent = profile
                        .pincode || 'N/A';

                    // Education
                    document.getElementById('collegeName').textContent = profile
                        .college_name || 'N/A';
                    document.getElementById('courseName').textContent = profile
                        .course || 'N/A';
                    document.getElementById('studyYear').textContent = profile
                        .study_year || 'N/A';

                    // Bio & Socials
                    document.getElementById('userBio').textContent = profile.bio ||
                        'No bio available.';
                    const socialLinksDiv = document.getElementById('socialLinks');
                    socialLinksDiv.innerHTML = '';

                    if (profile.social_links) {
                        try {
                            const links = JSON.parse(profile.social_links);
                            for (let key in links) {
                                const a = document.createElement('a');
                                a.href = links[key];
                                a.target = "_blank";
                                a.className = "btn btn-sm btn-outline-dark mr-2 mb-1";
                                a.innerHTML = `<i class="fab fa-${key}"></i> ${key}`;
                                socialLinksDiv.appendChild(a);
                            }
                        } catch (e) {
                            console.warn("Invalid social_links JSON", e);
                        }
                    }

                    // Badges
                    const setBadge = (id, status, positiveText, negativeText) => {
                        const el = document.getElementById(id);
                        el.textContent = status ? positiveText : negativeText;
                        el.className =
                            `badge badge-pill badge-${status ? 'success' : 'warning'}`;
                    };

                    setBadge('emailVerifyBadge', user.email_verified_at, 'Verified',
                        'Unverified');
                    setBadge('phoneVerifyBadge', !!user.phone, 'Verified',
                        'Unverified');
                    setBadge('aadharVerifyBadge', !!profile.aadhar, 'Verified',
                        'Pending');

                    // Document links
                    document.getElementById('aadharLink').href = profile.aadhar_url ||
                        '#';
                    document.getElementById('idCardLink').href = profile.id_card_url ||
                        '#';

                    const modalEl = document.getElementById('viewUserModal');
                    let modal;

                    if (bootstrap.Modal.getOrCreateInstance) {
                        modal = bootstrap.Modal.getOrCreateInstance(modalEl);
                    } else {
                        modal = new bootstrap.Modal(modalEl);
                    }
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
    let deleteButton = document.querySelector('#deleteUserModal #confirmDeleteBtn');

    // Update modal content dynamically
    document.querySelectorAll('[data-target="#deleteUserModal"]').forEach(button => {
        button.addEventListener('click', function() {
            const userId = this.getAttribute('data-id');
            const userName = this.getAttribute('data-name') || 'this user';

            // Update modal message
            document.querySelector('#deleteUserModal .modal-body p').textContent = 
                `Are you sure you want to delete ${userName}?`;

            // Reset the form fields when modal is opened
            document.querySelector('#deleteReason').value = '';
            document.querySelector('#deleteNote').value = '';

            // Replace old listener
            const newButton = deleteButton.cloneNode(true);
            deleteButton.parentNode.replaceChild(newButton, deleteButton);
            deleteButton = newButton;

            // Add fresh click event listener for the delete button
            deleteButton.addEventListener('click', function() {
                // Gather form data (Reason & Note)
                const reason = document.querySelector('#deleteReason').value;
                const note = document.querySelector('#deleteNote').value;

                // Validate the reason before sending
                if (!reason) {
                    alert('❌ Please select a reason for deletion.');
                    return;
                }

                // Send the deletion request to the server
                fetch(`/admin/users/${userId}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ reason: reason, note: note })
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
