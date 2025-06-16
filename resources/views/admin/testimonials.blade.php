@extends('layouts.admin')
@section('title', 'Testimonials')
@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

@endpush

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5>🌟 Testimonials</h5>
            <button class="btn btn-primary" data-toggle="modal" data-target="#addTestimonialModal">➕ Add New</button>
        </div>

        <div class="card-body table-responsive">
            <table class="table table-hover text-center align-middle table-bordered">
                <thead class="table-light">
                    <tr class="align-middle">
                        <th>#</th>
                        <th>👤 Name</th>
                        <th>📷 Photo</th>
                        <th>🏷️ Designation</th>
                        <th>⭐ Rating</th>
                        <th>💬 Message</th>
                        <th>📌 Status</th>
                        <th>⚙️ Actions</th>
                    </tr>
                </thead>

                <tbody>
                    
                    @forelse ($testimonials as $testimonial)
                        <tr id="row-{{ $testimonial->id }}">
                            <td>{{ $testimonial->id }}</td>

                            <td class="text-capitalize">{{ $testimonial->name }}</td>

                            <td>
                                <img src="{{ asset($testimonial->avatar) }}" alt="avatar"
                                    class="img-thumbnail rounded-circle shadow"
                                    style="height: 60px; width: 60px; object-fit: cover;">
                            </td>

                            <td class="text-capitalize">
                                <span class="badge bg-info text-dark">{{ $testimonial->role }}</span>
                            </td>

                            <td>
                                <span class="badge text-dark fs-4">
                                    {{ $testimonial->rating }} ⭐
                                </span>
                            </td>

                            <td class="text-start"
                                style="max-width: 250px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                {{ $testimonial->message }}
                            </td>


                            <td>
                                <button class="btn btn-link p-0 toggle-status-btn" data-id="{{ $testimonial->id }}"
                                    data-url="{{ route('admin.testimonials.toggleStatus', $testimonial->id) }}"
                                    style="font-size: 35px;" title="Toggle Status">
                                    
                                    @if ($testimonial->status == 'Active')
                                        <i class="bi bi-toggle2-on text-success fs-3"
                                            id="status-icon-{{ $testimonial->id }}"></i>
                                    @else
                                        <i class="bi bi-toggle2-off text-danger fs-3"
                                            id="status-icon-{{ $testimonial->id }}"></i>
                                    @endif

                                </button>
                            </td>


                            <td>
                                <button class="btn btn-sm btn-outline-primary edit-btn mb-1"
                                    data-id="{{ $testimonial->id }}" data-name="{{ $testimonial->name }}"
                                    data-role="{{ $testimonial->role }}" data-avatar="{{ asset($testimonial->avatar) }}"
                                    data-rating="{{ $testimonial->rating }}" data-message="{{ $testimonial->message }}"
                                    data-status="{{ $testimonial->status }}" data-toggle="modal"
                                    data-target="#editTestimonialModal">
                                    ✏️ Edit
                                </button>

                                <button class="btn btn-sm btn-outline-danger delete-btn" data-id="{{ $testimonial->id }}"
                                    data-url="{{ route('admin.testimonials.destroy', $testimonial->id) }}">
                                    🗑️ Delete
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-muted text-center">No testimonials found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- ✅ Pagination --}}
            <div class="d-flex justify-content-center mt-4">
                {{ $testimonials->links('pagination::bootstrap-5') }}
            </div>
        </div>


    </div>

    <!-- Add Testimonial Modal -->
    <div class="modal fade " id="addTestimonialModal" tabindex="-1" aria-hidden="true" role="dialog">
        <div class="modal-dialog modal-lg ">
            <form class="modal-content" id="addTestimonialForm">
                <div class="modal-header">
                    <h5 class="modal-title">➕ Add New Testimonial</h5>
                    <button type="button" class="close" data-dismiss="modal"><i class="fas fa-lg fa-times"></i></button>
                </div>

                <div class="modal-body row g-3">
                    <div class="col-md-6 form-group">
                        <label>👤 Customer Name *</label>
                        <input type="text" class="form-control" required name="name" />
                    </div>

                    <div class="col-md-6 form-group">
                        <label> Designation *</label>
                        <select class="form-control select2" required name="role">
                            <option value="">Select Desgination</option>
                            <option value="room_owner">Owner</option>
                            <option value="user">Student</option>

                        </select>
                    </div>

                    <div class="col-md-6 form-group">
                        <label>🖼️ Photo <small>(optional)</small></label>
                        <input type="file" class="form-control" accept="image/*" name="avatar" />
                    </div>

                    <div class="col-md-6 form-group">
                        <label>⭐ Rating *</label>
                        <select class="form-control select2" name="rating" required>
                            <option value="">Select Rating</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>

                    <div class="col-12 form-group">
                        <label>💬 Testimonial Message *</label>
                        <textarea class="form-control" rows="4" required name="message"></textarea>
                    </div>

                    <div class="col-6 form-group">
                        <label>📌 Status</label>
                        <select class="form-control select2" name="status">
                            <option value="1">Active</option>
                            <option value="2">Inactive</option>
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">💾 Save</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
    <!-- Edit Testimonial Modal -->
    <div class="modal fade" id="editTestimonialModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form class="modal-content" id="editTestimonialForm" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title">✏️ Edit Testimonial</h5>
                    <button type="button" class="close" data-dismiss="modal"><i
                            class="fas fa-lg fa-times"></i></button>
                </div>

                <div class="modal-body row g-3">
                    <input type="hidden" name="id" id="edit_id" />

                    <!-- 👤 Name -->
                    <div class="col-md-6 form-group">
                        <label>👤 Customer Name</label>
                        <div class="d-flex align-items-center">
                            <input type="text" id="edit_name" name="name" class="form-control" disabled />
                            <button type="button" class="btn btn-sm btn-light ms-2"
                                onclick="enableField('edit_name')">✏️</button>
                        </div>
                    </div>

                    <!-- 🏷️ Designation -->
                    <div class="col-md-6 form-group">
                        <label>🏷️ Designation</label>
                        <div class="d-flex align-items-center">
                            <select id="edit_role" name="role" class="form-control select2" disabled>
                                <option value="">Select Designation</option>
                                <option value="room_owner">Owner</option>
                                <option value="user">Student</option>
                            </select>
                            <button type="button" class="btn btn-sm btn-light ms-2"
                                onclick="enableField('edit_role')">✏️</button>
                        </div>
                    </div>

                    <!-- 🖼️ Photo -->
                    <div class="col-md-6 form-group">
                        <label>🖼️ Photo <small>(optional)</small></label>
                        <div class="d-flex align-items-center">
                            <input type="file" id="edit_avatar" name="avatar" class="form-control" disabled />
                            <button type="button" class="btn btn-sm btn-light ms-2"
                                onclick="enableField('edit_avatar')">✏️</button>
                        </div>
                    </div>

                    <!-- ⭐ Rating -->
                    <div class="col-md-6 form-group">
                        <label>⭐ Rating</label>
                        <div class="d-flex align-items-center">
                            <select id="edit_rating" name="rating" class="form-control select2" disabled>
                                <option value="">Select Rating</option>
                                @for ($i = 1; $i <= 5; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                            <button type="button" class="btn btn-sm btn-light ms-2"
                                onclick="enableField('edit_rating')">✏️</button>
                        </div>
                    </div>

                    <!-- 💬 Message -->
                    <div class="col-12 form-group">
                        <label>💬 Testimonial Message</label>
                        <div class="d-flex align-items-center">
                            <textarea id="edit_message" name="message" class="form-control" rows="4" disabled></textarea>
                            <button type="button" class="btn btn-sm btn-light ms-2"
                                onclick="enableField('edit_message')">✏️</button>
                        </div>
                    </div>

                    <!-- 📌 Status -->
                    <div class="col-6 form-group">
                        <label>📌 Status</label>
                        <div class="d-flex align-items-center">
                            <select id="edit_status" name="status" class="form-control select2" disabled>
                                <option value="1">Active</option>
                                <option value="2">Inactive</option>
                            </select>
                            <button type="button" class="btn btn-sm btn-light ms-2"
                                onclick="enableField('edit_status')">✏️</button>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">💾 Update</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.toggle-status-btn').forEach(button => {
                button.addEventListener('click', async function() {
                    const btn = this;
                    const url = btn.getAttribute('data-url');
                    const id = btn.getAttribute('data-id');
                    const icon = document.getElementById(`status-icon-${id}`);

                    try {
                        const response = await fetch(url, {
                            method: 'PATCH',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json'
                            }
                        });
                        const result = await response.json();

                        if (response.ok && result.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Status Updated',
                                text: result.message,
                                timer: 1200,
                                showConfirmButton: false
                            });
                            console.log(result);

                            if (result.status == 'active') {
                                icon.className = 'bi bi-toggle2-on text-success fs-3';
                            } else {
                                icon.className = 'bi bi-toggle2-off text-danger fs-3';
                            }

                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Failed!',
                                text: result.message || 'Status toggle failed',
                            });
                        }
                    } catch (error) {
                        console.error(error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Server Error',
                            text: 'Please try again later.'
                        });
                    }
                });
            });
        });
    </script>


    <!--enable button for fileds  -->
    <script>
        function enableField(id) {
            document.getElementById(id).removeAttribute('disabled');
        }
    </script>
    <!-------------------- this js fills all form fields --------------------------->
    <script>
        document.addEventListener('click', function(e) {
            const btn = e.target.closest('.edit-btn');

            if (btn) {
                // Get data from button
                document.getElementById('edit_id').value = btn.dataset.id;
                document.getElementById('edit_name').value = btn.dataset.name;
                document.getElementById('edit_role').value = btn.dataset.role;
                document.getElementById('edit_rating').value = btn.dataset.rating;
                document.getElementById('edit_message').value = btn.dataset.message;
                document.getElementById('edit_status').value = btn.dataset.status;

                // Optional: Preview image
                if (btn.dataset.avatar) {
                    const imgPreview = document.createElement('img');
                    imgPreview.src = btn.dataset.avatar;
                    imgPreview.className = 'img-thumbnail my-2';
                    imgPreview.style.maxHeight = '80px';

                    // Remove previous preview if any
                    const container = document.getElementById('edit_avatar_preview');
                    container.innerHTML = '';
                    container.appendChild(imgPreview);
                }
            }
        });
    </script>
    <!-------------------  ajax code for sumbmiting form ---------------------------->
    <script>
        document.getElementById('editTestimonialForm').addEventListener('submit', async function(e) {
            e.preventDefault();

            const form = this;
            form.querySelectorAll(':disabled').forEach(el => el.disabled = false);

            const formData = new FormData(form);
            const id = formData.get('id'); // Hidden input field se id le lo

            // 🔒 1 MB = 1 * 1024 * 1024 = 1048576 bytes
            const avatarFile = form.querySelector('input[name="avatar"]').files[0];
            if (avatarFile && avatarFile.size > 1048576) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Image too large!',
                    text: 'Please upload an image smaller than 1 MB.',
                });
                return;
            }

            // Laravel PUT ke liye method spoofing
            formData.append('_method', 'PUT');

            try {
                const response = await fetch(`/admin/testimonials/${id}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: formData
                });

                const result = await response.json();

                if (response.ok && result.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: result.message,
                        timer: 1500
                    });

                    form.reset();
                    $('#editTestimonialModal').modal('hide');

                    // Page reload or table update karo yahan
                    location.reload();

                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: result.message || 'Something went wrong',
                    });
                }
            } catch (error) {
                console.error(error);
                Swal.fire({
                    icon: 'error',
                    title: 'Server Error!',
                    text: 'Please try again later.'
                });
            }
        });
    </script>


    <script>
        document.getElementById('addTestimonialForm').addEventListener('submit', async function(e) {
            e.preventDefault();

            const formData = new FormData(this);

            try {
                const response = await fetch("{{ route('admin.testimonials.store') }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: formData
                });

                const result = await response.json();
                console.log(result);

                if (response.ok && result.success) {
                    swal.fire({
                        title: 'Success!',
                        text: result.message,
                        icon: 'success',
                        timer: 1500,
                        confirmButtonText: 'OK'
                    });
                    this.reset();
                    // Reload the page to see the new testimonial
                    location.reload();

                } else {
                    swal.fire({
                        title: 'Error!',
                        text: result.message || 'Something went wrong',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });

                }
            } catch (error) {
                swal.fire({
                    title: 'Error!',
                    text: 'Server error. Please try again later.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });

            }
        });
    </script>
    <!---ajax script for delete testimonial -->
    <script>
        document.addEventListener('click', async function(e) {
            const button = e.target.closest('.delete-btn');

            if (button) {
                const id = button.dataset.id;
                const url = button.dataset.url;


                const result = await Swal.fire({
                    title: 'Are you sure?',
                    text: "This testimonial will be deleted permanently.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel'
                });


                if (result.isConfirmed) {
                    try {
                        const response = await fetch(url, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json'
                            }
                        });

                        const result = await response.json();

                        if (response.ok && result.success) {

                            Swal.fire('Deleted!', result.message, 'success');


                            const row = document.getElementById(`row-${id}`);
                            if (row) row.remove();
                        } else {
                            Swal.fire('Error!', result.message || 'Delete failed', 'error');
                        }

                    } catch (error) {
                        console.error(error);
                        Swal.fire('Error!', 'Server error. Please try again later.', 'error');
                    }
                }
            }
        });
    </script>
@endpush
