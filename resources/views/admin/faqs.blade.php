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
            <button class="btn btn-primary" data-toggle="modal" data-target="#addFaqModal">➕ Add New FAQ</button>
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
                        <option value="technical">Technical</option>
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
                                @if ($faq->is_active === 1)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Inactive</span>
                                @endif
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
                        <td colspan="6" class="text-center text-muted">{{ $faqs->links('pagination::bootstrap-5') }}</td>
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
    <!-- Bootstrap 5 -->
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script> --}}

    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end', // top-start, top-end, top-right bhi use kar sakte ho
            showConfirmButton: false,
            timer: 3000, // toast auto close time
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });



        //Add Faq Modal
        document.getElementById('addFaqForm').addEventListener('submit', function(e) {
            e.preventDefault();
            this.submit();
            fetch('/admin/faqs', {
                method: 'POST',
                body: new FormData(this)
            }).then(response => response.json()).then(data => {
                if (data.success) {
                    Toast.fire({
                        icon: 'success',
                        title: data.message
                    });
                    document.getElementById('addFaqForm').reset();
                }
            })
        })
        // View FAQ Modal
        document.querySelectorAll('.view-faq-btn').forEach(button => {
            button.addEventListener('click', function() {

                let url = this.getAttribute('data-url');

                // Fetch FAQ details from server
                fetch(url)
                    .then(response => response.json())
                    .then(faq => {

                        document.getElementById('view-question').textContent = faq.question;
                        document.getElementById('view-answer').innerHTML = faq.answer;
                        document.getElementById('view-category').innerText = faq.category || '—';
                        document.getElementById('view-status').innerText = faq.is_active ? 'Active' :
                            'Inactive';
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
                let url = this.getAttribute('data-url');
                let faqId = this.getAttribute('data-id');
                let showUrl = "{{ route('admin.faqs.show', ':id') }}".replace(':id', faqId);

                fetch(showUrl)
                    .then(res => res.json())
                    .then(faq => {
                        document.getElementById('edit-id').value = faq.id;
                        document.getElementById('edit-question').value = faq.question;
                        document.getElementById('edit-answer').value = faq.answer;
                        document.getElementById('edit-category').value = faq.category;
                        document.getElementById('edit-status').value = faq.is_active;

                        // Set form action URL here
                        document.getElementById('editFaqForm').action =
                            url; // Dynamic URL for form submission

                        let modal = new bootstrap.Modal(document.getElementById('editFaqModal'));
                        modal.show();
                    })
                    .catch(err => {
                        console.error("Error fetching FAQ:", err);
                        alert("Could not load FAQ for editing.");
                    });
            });
        });
        document.getElementById('editFaqForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const form = this;
            const url = form.action;

            // Log the values of the fields to check if they are populated
            console.log({
                question: document.getElementById('edit-question').value,
                answer: document.getElementById('edit-answer').value,
                category: document.getElementById('edit-category').value,
                is_active: document.getElementById('edit-status').value
            });

            // Ensure that FormData is correctly populated
            const formData = new FormData(form);
            console.log([...formData]);

            fetch(url, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}",
                        'Accept': 'application/json'
                    },
                    body: formData
                }).then(async (response) => {
                    if (!response.ok) {
                        const errorData = await response.json();
                        throw errorData;
                    }
                    const data = await response.json();
                    alert('✅ FAQ updated!');
                    location.reload();
                })
                .catch((error) => {
                    console.error("Error updating FAQ:", error);
                });
        });


        document.querySelectorAll('.delete-faq-btn').forEach(button => {
            button.addEventListener('click', function() {
                let faqId = this.getAttribute('data-id');
                console.log(faqId);
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
                                location.reload();
                                alert('✅ FAQ deleted!');
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
