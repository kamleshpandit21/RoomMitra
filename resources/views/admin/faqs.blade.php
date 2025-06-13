@extends('layouts.admin')
@section('title', 'FAQ Management')
@push('styles')
    <style>
        /* Toggle Switch Style */
        .switch {
            position: relative;
            display: inline-block;
            width: 50px;
            height: 24px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: .4s;
            border-radius: 24px;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 18px;
            width: 18px;
            left: 3px;
            bottom: 3px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
        }

        input:checked+.slider {
            background-color: #28a745;
        }

        input:checked+.slider:before {
            transform: translateX(26px);
        }
    </style>
@endpush

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                <h3 class="card-title">FAQ Management</h3>
            </div>
            <button class="btn btn-primary" data-toggle="modal" data-target="#addFaqModal">➕ Add New FAQ</button>
        </div>
        <div class="card-body table-responsive">
            <!-- Filters -->
            <div class="row mb-3">
                <div class="col-md-4">
                    <input type="text" class="form-control" id="filter-search" name="search"
                        value="{{ request('search') }}" placeholder="Search by question or tag...">
                </div>

                <div class="col-md-3">
                    <select class="form-control select2bs4" id="filter-category" name="category">
                        <option value="">Filter by Category</option>
                        <option value="booking" {{ request('category') == 'booking' ? 'selected' : '' }}>Booking</option>
                        <option value="payment" {{ request('category') == 'payment' ? 'selected' : '' }}>Payment</option>
                        <option value="general" {{ request('category') == 'general' ? 'selected' : '' }}>General</option>
                        <option value="technical" {{ request('category') == 'technical' ? 'selected' : '' }}>Technical
                        </option>
                    </select>
                </div>

                <div class="col-md-2">
                    <select class="form-control select2bs4" id="filter-status" name="status">
                        <option value="">Status</option>
                        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                <!-- Clear Button -->
                <div class="col-md-3">
                    <a href="{{ route('admin.faqs.index') }}" class="btn btn-outline-secondary w-100">🔄 Clear Filters</a>
                </div>
            </div>


            <!-- Table -->
            <table class="table table-hover align-middle" id="faq-table">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>❓ Question</th>
                        <th>📂 Category</th>
                        <th>📌 Status</th>
                        <th>📅 Created</th>
                        <th>⚙️ Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($faqs as $faq)
                        <tr>
                            <td>#{{ $faq->id }}</td>
                            <td>{{ Str::limit($faq->question, 60) }}</td>
                            <td>{{ ucfirst($faq->category ?? '-') }}</td>
                            <td>
                                <label class="switch">
                                    <input type="checkbox" class="faq-toggle" data-id="{{ $faq->id }}"
                                        {{ $faq->is_active ? 'checked' : '' }}>
                                    <span class="slider round"></span>
                                </label>
                            </td>
                            <td>{{ $faq->created_at->format('d M Y') }}</td>
                            <td class="d-flex gap-2 flex-wrap justify-content-between ">
                                <button class="btn btn-sm btn-outline-info view-faq-btn"
                                    data-url="{{ route('admin.faqs.show', $faq->id) }}">
                                    👁️ View
                                </button>
                                <button class="btn btn-sm btn-outline-primary edit-faq-btn"
                                    data-url="{{ route('admin.faqs.update', $faq->id) }}" data-id="{{ $faq->id }}">
                                    ✏️ Edit
                                </button>

                                <button class="btn btn-sm btn-outline-danger delete-faq-btn" data-id="{{ $faq->id }}"
                                    data-url="{{ route('admin.faqs.destroy', $faq->id) }}">
                                    🗑️ Delete
                                </button>

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">No FAQs found.</td>
                        </tr>
                    @endforelse

                    <tr>
                        <td colspan="6" class="text-center text-muted">{{ $faqs->links('pagination::bootstrap-5') }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Add FAQ Modal -->
    <div class="modal fade" id="addFaqModal" tabindex="-1" aria-labelledby="addFaqLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form class="modal-content" id="addFaqForm" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addFaqLabel">➕ Add New FAQ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label>Question</label>
                        <input type="text" class="form-control" name="question" required>
                    </div>

                    <div class="mb-3">
                        <label>Answer</label>
                        <textarea class="form-control" name="answer" rows="3" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label>Category</label>
                        <select class="form-control" name="category">
                            <option value="booking">Booking</option>
                            <option value="payment">Payment</option>
                            <option value="general">General</option>
                            <option value="technical">Technical</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Status</label>
                        <select class="form-control" name="is_active">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>


    </div>


    <!-- Edit FAQ Modal -->
    <div class="modal fade" id="editFaqModal" tabindex="-1" aria-labelledby="editFaqLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form class="modal-content" id="editFaqForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editFaqLabel">✏️ Edit FAQ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <input type="hidden" name="id" id="edit-id">

                    <div class="mb-3">
                        <label>Question</label>
                        <input type="text" class="form-control" name="question" id="edit-question" required>
                    </div>

                    <div class="mb-3">
                        <label>Answer</label>
                        <textarea class="form-control" name="answer" rows="4" id="edit-answer"></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Category</label>
                            <select class="form-control" name="category" id="edit-category">
                                <option value="">Select Category</option>
                                <option value="General Questions">General Questions</option>
                                <option value="For Students (Users)">For Students (Users)</option>
                                <option value="For Room Owners">For Room Owners</option>
                                <option value="Security & Verification">Security & Verification</option>
                                <option value="Technical Questions">Technical Questions</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Status</label>
                            <select class="form-control" name="is_active" id="edit-status">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">💾 Update</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>


    <!-- View FAQ Modal -->
    <div class="modal fade" id="viewFaqModal" tabindex="-1" aria-labelledby="viewFaqLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewFaqLabel">📖 FAQ Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                </div>
                <div class="modal-body">
                    <!-- FAQ Question -->
                    <h5 id="view-question" class="mb-3 fw-bold">Loading...</h5>

                    <!-- FAQ Answer -->
                    <div class="mb-2">
                        <strong>Answer:</strong>
                        <p id="view-answer">Loading...</p>
                    </div>

                    <!-- FAQ Category -->
                    <div class="mb-2">
                        <strong>Category:</strong>
                        <span id="view-category">Loading...</span>
                    </div>

                    <!-- FAQ Status -->
                    <div class="mb-2">
                        <strong>Status:</strong>
                        <span id="view-status">Loading...</span>
                    </div>


                    <!-- FAQ Created At -->
                    <div class="mb-2">
                        <strong>Created At:</strong>
                        <span id="view-date">Loading...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        // Toast setup
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true
        });

        // Utility function to fetch JSON with CSRF
        async function fetchWithCSRF(url, method = 'GET', body = null) {
            const headers = {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            };

            const response = await fetch(url, {
                method,
                headers,
                body
            });

            if (!response.ok) throw await response.json();
            return await response.json();
        }

        // Toggle FAQ status
        function initFaqToggle() {
            document.querySelectorAll('.faq-toggle').forEach(toggle => {
                toggle.addEventListener('click', async function() {
                    const faqId = this.dataset.id;
                    try {
                        const data = await fetchWithCSRF(`/admin/faqs/${faqId}/toggle-status`, 'PATCH');
                        Toast.fire({
                            icon: 'success',
                            title: data.success ? '✅ FAQ activated' : '❌ FAQ deactivated'
                        });
                    } catch (err) {
                        console.error(err);
                        Toast.fire({
                            icon: 'error',
                            title: 'An error occurred. Please try again.'
                        });
                    }
                });
            });
        }

        // Add FAQ
        function initAddFaqForm() {
            const form = document.getElementById('addFaqForm');
            form.addEventListener('submit', async function(e) {
                e.preventDefault();
                const submitBtn = form.querySelector('button[type="submit"]');
                submitBtn.disabled = true;
                submitBtn.innerText = 'Submitting...';

                try {
                    const response = await fetch('/admin/faqs', {
                        method: 'POST',
                        body: new FormData(form)
                    });
                    const data = await response.json();

                    Toast.fire({
                        icon: data.success ? 'success' : 'error',
                        title: data.message || 'Submission failed.'
                    });

                    if (data.success) {
                        form.reset();
                        $('#addFaqModal').modal('hide');
                    }
                } catch (error) {
                    console.error(error);
                    Toast.fire({
                        icon: 'error',
                        title: 'An error occurred. Please try again.'
                    });
                } finally {
                    submitBtn.disabled = false;
                    submitBtn.innerText = 'Submit';
                }
            });
        }

        // View FAQ
        function initViewFaqButtons() {
            document.querySelectorAll('.view-faq-btn').forEach(button => {
                button.addEventListener('click', async function() {
                    try {
                        const url = this.dataset.url;
                        const faq = await (await fetch(url)).json();

                        document.getElementById('view-question').textContent = faq.question;
                        document.getElementById('view-answer').innerHTML = faq.answer;
                        document.getElementById('view-category').innerText = faq.category || '—';
                        document.getElementById('view-status').innerText = faq.is_active ? 'Active' :
                            'Inactive';
                        document.getElementById('view-date').innerText = new Date(faq.created_at)
                            .toLocaleString();

                        new bootstrap.Modal(document.getElementById('viewFaqModal')).show();
                    } catch (error) {
                        Toast.fire({
                            icon: 'error',
                            title: 'An error occurred. Please try again.'
                        });
                    }
                });
            });
        }

        // Edit FAQ
        function initEditFaqButtons() {
            document.querySelectorAll('.edit-faq-btn').forEach(button => {
                button.addEventListener('click', async function() {
                    const faqId = this.dataset.id;
                    const showUrl = `{{ route('admin.faqs.show', ':id') }}`.replace(':id', faqId);
                    const updateUrl = this.dataset.url;

                    try {
                        const faq = await (await fetch(showUrl)).json();

                        document.getElementById('edit-id').value = faq.id;
                        document.getElementById('edit-question').value = faq.question;
                        document.getElementById('edit-answer').value = faq.answer;
                        document.getElementById('edit-category').value = faq.category;
                        document.getElementById('edit-status').value = faq.is_active;
                        document.getElementById('editFaqForm').action = updateUrl;

                        new bootstrap.Modal(document.getElementById('editFaqModal')).show();
                    } catch (err) {
                        Toast.fire({
                            icon: 'error',
                            title: 'An error occurred. Please try again.'
                        });
                    }
                });
            });
        }

        function initEditFaqForm() {
            document.getElementById('editFaqForm').addEventListener('submit', async function(e) {
                e.preventDefault();
                const form = this;
                const formData = new FormData(form);

                try {
                    await fetchWithCSRF(form.action, 'POST', formData);
                    Toast.fire({
                        icon: 'success',
                        title: '✅ FAQ updated!'
                    })
                } catch (error) {
                    Toast.fire({
                        icon: 'error',
                        title: 'An error occurred. Please try again.'
                    });
                }
            });
        }

        // Delete FAQ
        function initDeleteFaqButtons() {
            document.querySelectorAll('.delete-faq-btn').forEach(button => {
                button.addEventListener('click', async function() {
                    const faqId = this.dataset.id;
                    if (!confirm('Are you sure you want to delete this FAQ?')) return;

                    try {
                        await fetchWithCSRF(`/admin/faqs/${faqId}`, 'DELETE');
                        Toast.fire({
                            icon: 'success',
                            title: 'FAQ deleted!'
                        })

                    } catch (error) {
                        Toast.fire({
                            icon: 'error',
                            title: 'Something went wrong. Please try again.'
                        });
                    }
                });
            });
        }

        // Init all
        initFaqToggle();
        initAddFaqForm();
        initViewFaqButtons();
        initEditFaqButtons();
        initEditFaqForm();
        initDeleteFaqButtons();

        // Automatically submit filter on change or typing
        document.getElementById('filter-search').addEventListener('input', debounce(() => {
            submitFilters();
        }, 500));

        document.getElementById('filter-category').addEventListener('change', submitFilters);
        document.getElementById('filter-status').addEventListener('change', submitFilters);

        function submitFilters() {
            const search = document.getElementById('filter-search').value;
            const category = document.getElementById('filter-category').value;
            const status = document.getElementById('filter-status').value;

            const params = new URLSearchParams();
            if (search) params.append('search', search);
            if (category) params.append('category', category);
            if (status) params.append('status', status);

            window.location.href = `?${params.toString()}`;
        }

        // Debounce function to avoid rapid firing
        function debounce(func, delay) {
            let timeout;
            return function() {
                clearTimeout(timeout);
                timeout = setTimeout(func, delay);
            };
        }
    </script>
@endpush
