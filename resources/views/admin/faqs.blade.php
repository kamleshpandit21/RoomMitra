@extends('layouts.admin')
@section('title', 'FAQ Management')
@push('styles')
@endpush

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                <h3 class="card-title">FAQ Management</h3>
            </div>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addFaqModal">➕ Add New FAQ</button>
        </div>
        <div class="card-body table-responsive">
            <!-- Filters -->
            <div class="row mb-3">
                <div class="col-md-4">
                    <input type="text" class="form-control" id="filter-search" placeholder="Search by question or tag...">
                </div>
                <div class="col-md-3 form-group">
                    <select class="form-control select2bs4" id="filter-category">
                        <option value="">Filter by Category</option>
                        <option value="booking">Booking</option>
                        <option value="payment">Payment</option>
                        <option value="general">General</option>
                    </select>
                </div>
                <div class="col-md-3 form-group">
                    <select class="form-control select2bs4" id="filter-status">
                        <option value="">Status</option>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
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
                                @if ($faq->status === 'active')
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Inactive</span>
                                @endif
                            </td>
                            <td>{{ $faq->created_at->format('d M Y') }}</td>
                            <td>
                                <button class="btn btn-sm btn-outline-info view-faq-btn" data-id="{{ $faq->id }}">
                                    👁️ View
                                </button>
                                <button class="btn btn-sm btn-outline-primary edit-faq-btn" data-id="{{ $faq->id }}">
                                    ✏️ Edit
                                </button>

                                <button class="btn btn-sm btn-outline-danger delete-faq-btn" data-id="{{ $faq->id }}">
                                    🗑️ Delete
                                </button>

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">No FAQs found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
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
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                        <div class="col-md-4 mb-3">
                            <label>Category</label>
                            <select class="form-control select2bs4" name="category" id="edit-category">
                                <option value="booking">Booking</option>
                                <option value="payment">Payment</option>
                                <option value="technical">Technical</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Status</label>
                            <select class="form-control select2bs4" name="status" id="edit-status">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Order</label>
                            <input type="number" class="form-control" name="order" id="edit-order">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label>Tags</label>
                        <input type="text" class="form-control" name="tags" id="edit-tags">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">💾 Update</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Add/Edit FAQ Modal -->
    <div class="modal fade" id="addFaqModal" tabindex="-1" aria-labelledby="faqModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form class="modal-content" method="post" action="{{ route('admin.faqs.store') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="faqModalLabel">➕ Add New FAQ</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><i
                            class="fas fa-times"></i></button>
                </div>
                <div class="modal-body">
                    {{-- Validation Errors --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Oops!</strong> Please fix the following errors:
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- FAQ Fields -->
                    <div class="mb-3">
                        <label>Question</label>
                        <input type="text" class="form-control" placeholder="Enter the FAQ question" required
                            name="question">
                        @error('question')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Other fields for answer, category, etc. -->
                    <div class="mb-3">
                        <label>Answer</label>
                        <textarea class="form-control wysiwyg" rows="5" placeholder="Enter detailed answer..." name="answer"></textarea>
                        @error('answer')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Category, Status, Order and Tags -->
                    <div class="row">
                        <div class="col-md-4 mb-3 form-group">
                            <label>Category</label>
                            <select class="form-control select2bs4" name="category">
                                <option value="">Select Category</option>
                                <option value="booking">Booking</option>
                                <option value="payment">Payment</option>
                                <option value="technical">Technical</option>
                            </select>
                            @error('category')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3 form-group">
                            <label>Status</label>
                            <select class="form-control select2bs4" name="status">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Order</label>
                            <input type="number" class="form-control" placeholder="Sorting order" name="order">
                            @error('order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label>Tags <small>(optional, comma-separated)</small></label>
                        <input type="text" class="form-control" placeholder="e.g., refund, payment delay"
                            name="tags">
                        @error('tags')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">💾 Save FAQ</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><i
                            class="fas fa-times"></i></button>

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

                    <!-- FAQ Tags -->
                    <div class="mb-2">
                        <strong>Tags:</strong>
                        <span id="view-tags">Loading...</span>
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
    <!-- Bootstrap 5 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Attach click event listener to each "view" button
        document.querySelectorAll('.view-faq-btn').forEach(button => {
            button.addEventListener('click', function() {
                let faqId = this.getAttribute('data-id');

                // Fetch FAQ details from server
                fetch(`/admin/faqs/${faqId}`)
                    .then(response => response.json())
                    .then(faq => {
                        document.getElementById('view-question').textContent = faq.question;
                        document.getElementById('view-answer').innerHTML = faq.answer;
                        document.getElementById('view-category').innerText = faq.category || '—';
                        document.getElementById('view-status').innerText = faq.status;
                        document.getElementById('view-tags').innerText = faq.tags || '—';
                        document.getElementById('view-date').innerText = new Date(faq.created_at)
                            .toLocaleString();

                        // Show the modal (Bootstrap 5 method)
                        var myModal = new bootstrap.Modal(document.getElementById('viewFaqModal'));
                        myModal.show();
                    })
                    .catch(error => {
                        console.error('Error fetching FAQ details:', error);
                        alert('Unable to fetch FAQ details.');
                    });
            });
        });
        document.querySelectorAll('.edit-faq-btn').forEach(button => {
            button.addEventListener('click', function() {
                let faqId = this.getAttribute('data-id');

                fetch(`/admin/faqs/${faqId}`)
                    .then(res => res.json())
                    .then(faq => {
                        // Fill the form fields
                        document.getElementById('edit-id').value = faq.id;
                        document.getElementById('edit-question').value = faq.question;
                        document.getElementById('edit-answer').value = faq.answer;
                        document.getElementById('edit-category').value = faq.category;
                        document.getElementById('edit-status').value = faq.status;
                        document.getElementById('edit-order').value = faq.order;
                        document.getElementById('edit-tags').value = faq.tags;

                        // Set form action
                        document.getElementById('editFaqForm').action = `/admin/faqs/${faqId}`;

                        // Show modal
                        let modal = new bootstrap.Modal(document.getElementById('editFaqModal'));
                        modal.show();
                    })
                    .catch(err => {
                        console.error("Error fetching FAQ:", err);
                        alert("Could not load FAQ for editing.");
                    });
            });
        });


        document.querySelectorAll('.delete-faq-btn').forEach(button => {
            button.addEventListener('click', function() {
                let faqId = this.getAttribute('data-id');

                if (confirm('Are you sure you want to delete this FAQ?')) {
                    fetch(`/admin/faqs/${faqId}`, {
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
                                alert('Failed to delete FAQ.');
                            }
                        })
                        .catch(error => {
                            console.error('Delete error:', error);
                            alert('Something went wrong while deleting the FAQ.');
                        });
                }
            });
        });


        function filterFaqs() {
            const search = document.getElementById('filter-search').value.toLowerCase();
            const category = document.getElementById('filter-category').value.toLowerCase();
            const status = document.getElementById('filter-status').value.toLowerCase();

            document.querySelectorAll('#faq-table tbody tr').forEach(row => {
                const question = row.children[1].innerText.toLowerCase();
                const cat = row.children[2].innerText.toLowerCase();
                const stat = row.children[3].innerText.toLowerCase();

                const matchesSearch = question.includes(search);
                const matchesCategory = category === '' || cat === category;
                const matchesStatus = status === '' || stat.includes(status);

                row.style.display = (matchesSearch && matchesCategory && matchesStatus) ? '' : 'none';
            });
        }

        document.getElementById('filter-search').addEventListener('input', filterFaqs);
        document.getElementById('filter-category').addEventListener('change', filterFaqs);
        document.getElementById('filter-status').addEventListener('change', filterFaqs);
    </script>
@endpush
