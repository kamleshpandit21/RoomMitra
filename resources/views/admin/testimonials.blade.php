@extends('layouts.admin')
@section('title', 'Testimonials')
@push('styles')
@endpush

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5>🌟 Testimonials</h5>
            <button class="btn btn-primary" data-toggle="modal" data-target="#addTestimonialModal">➕ Add New</button>
        </div>

        <div class="card-body table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>👤 Name</th>
                        <th>🏷️ Designation</th>
                        <th>⭐ Rating</th>
                        <th>💬 Message</th>
                        <th>📌 Status</th>
                        <th>⚙️ Actions</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @forelse ($testimonials as $testimonial )
            <tr>
              <td>{{ $testimonial->id }}</td>
              <td>{{ $testimonial->name }}</td>
              <td>{{ $testimonial->designation }}</td>
              <td>{{ $testimonial->rating }}</td>
              <td>{{ $testimonial->message }}</td>
              <td>
                @if ($testimonial->status == 'active')
                  <span class="badge bg-success">Active</span>
                @else
                  <span class="badge bg-danger">Inactive</span>
                @endif
              </td>
              <td>
                <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editTestimonialModal" data-id="{{ $testimonial->id }}">✏️</button>
                <button class="btn btn-sm btn-outline-danger" data-url="{{ route('admin.testimonials.destroy', $testimonial->id) }}"="">🗑️</button>
              </td>
            </tr>
          @empty
            
          @endforelse --}}
                    <tr>
                        <td>1</td>
                        <td>Riya Sharma</td>
                        <td>Student</td>
                        <td>⭐⭐⭐⭐⭐</td>
                        <td>“Amazing experience staying here!”</td>
                        <td><span class="badge bg-success">Active</span></td>
                        <td>
                            <button class="btn btn-sm btn-outline-primary">✏️</button>
                            <button class="btn btn-sm btn-outline-danger">🗑️</button>
                        </td>
                    </tr>
                    <!-- More rows... -->
                </tbody>
            </table>
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
                        <input type="text" class="form-control" required />
                    </div>

                    <div class="col-md-6 form-group">
                        <label>🏷️ Designation <small>(optional)</small></label>
                        <input type="text" class="form-control" />
                    </div>

                    <div class="col-md-6 form-group">
                        <label>🖼️ Photo <small>(optional)</small></label>
                        <input type="file" class="form-control" accept="image/*" />
                    </div>

                    <div class="col-md-6 form-group">
                        <label>⭐ Rating *</label>
                        <select class="form-control select2" required>
                            <option value="">Select Rating</option>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                        </select>
                    </div>

                    <div class="col-12 form-group">
                        <label>💬 Testimonial Message *</label>
                        <textarea class="form-control" rows="4" required></textarea>
                    </div>

                    <div class="col-6 form-group">
                        <label>📌 Status</label>
                        <select class="form-control select2">
                            <option>Active</option>
                            <option>Inactive</option>
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

@endsection

@push('scripts')
    <script>
        document.getElementById('addTestimonialForm').addEventListener('submit', async function(e) {
            e.preventDefault();

            const formData = new FormData(this);

            const response = await fetch("{{ route('admin.testimonials.store') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: formData
            });

            const raw = await response.text();
            console.log("Raw Response:", raw);

            try {
                const data = JSON.parse(raw);
                console.log("Parsed JSON:", data);
            } catch (err) {
                console.error("Invalid JSON:", err);
            }

            // Perform form submission logic here

        });
    </script>
@endpush
