@extends('layouts.app')
@section('title', 'Complaint')
@push('styles')
    <style>

    </style>
@endpush
@section('content')
    <section class="contact-us bg-light " id="contact" style="padding: 140px 0 80px 0;">
        <div class="container-fluid px-4 px-md-5">


            <section class="py-5 bg-light" id="why-choose-us" data-aos="fade-up">

                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-12 text-center mb-5">
                            <h2 class="display-5 fw-bold mb-3 heading">👉 Need Help? We're Here For You!</h2>
                            <p class="text-muted">We're here to help you with any issues or concerns you may have.</p>
                        </div>
                    </div>
                    <div class="row g-4">
                        <?php
                        $categories = [
                            ['icon' => '<svg width="44" height="44" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
  <path d="M3 10L12 3L21 10V20A1 1 0 0 1 20 21H4A1 1 0 0 1 3 20V10Z" stroke="white" stroke-width="1.5"/>
  <path d="M9 21V14H15V21" stroke="white" stroke-width="1.5"/>
</svg>
', 'title' => 'Room Booking', 'desc' => 'Issues with room search, booking, cancellation'],
                            ['icon' => '<svg width="44" height="44" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
  <rect x="2" y="5" width="20" height="14" rx="2" stroke="white" stroke-width="1.5"/>
  <path d="M2 9H22" stroke="white" stroke-width="1.5"/>
  <path d="M6 15H8" stroke="white" stroke-width="1.5"/>
</svg>
', 'title' => 'Payments & Refunds', 'desc' => 'Failed payments, refund status, invoice help'],
                            ['icon' => '<svg width="44" height="44" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
  <circle cx="12" cy="7" r="4" stroke="white" stroke-width="1.5"/>
  <path d="M4 20C4 16 8 14 12 14C16 14 20 16 20 20" stroke="white" stroke-width="1.5"/>
</svg>
', 'title' => 'Account Issues', 'desc' => 'Login, password reset, email/phone update'],
                            ['icon' => '<svg width="44" height="44" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
  <path d="M22 2L11 13" stroke="white" stroke-width="1.5"/>
  <path d="M22 2L15 22L11 13L2 9L22 2Z" stroke="white" stroke-width="1.5"/>
</svg>
', 'title' => 'Complaints', 'desc' => 'Lodge a complaint regarding room or owner'],
                            ['icon' => '<svg width="44" height="44" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
  <path d="M6 2H14L20 8V22H6V2Z" stroke="white" stroke-width="1.5"/>
  <path d="M14 2V8H20" stroke="white" stroke-width="1.5"/>
</svg>
', 'title' => 'Documents', 'desc' => 'ID upload, verification, document policies'],
                            ['icon' => '<svg width="44" height="44" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
  <path d="M22 12.1A6.95 6.95 0 0 1 13.9 4L11 6.9L17.1 13L20 10.1A6.96 6.96 0 0 1 22 12.1Z" stroke="white" stroke-width="1.5"/>
  <path d="M2 22L10 14" stroke="white" stroke-width="1.5"/>
</svg>
', 'title' => 'Technical Support', 'desc' => 'Website not loading, buttons not working etc'],
                        ];
                        
                        foreach ($categories as $category): ?>
                        <div class="col-md-4">
                            <div class="service-card h-100 p-4 text-center">
                                <div class="icon-wrapper mb-3" style="font-size: 2.5rem;">
                                    <?= $category['icon'] ?>
                                </div>
                                <h4 class="service-title mb-2"><?= htmlspecialchars($category['title']) ?></h4>
                                <p class="service-text mb-0 text-muted"><?= htmlspecialchars($category['desc']) ?></p>
                            </div>
                        </div>
                        <?php endforeach; ?>

                    </div>


                </div>
            </section>
            <!-- Contact Section -->
            <div class="row g-5">

                <!-- Contact Info -->
                <div class="col-lg-5">
                    <div class="bg-white p-4 p-md-5 rounded-4 h-100 animate__animated animate__fadeInLeft">
                        <h3 class="fw-bold mb-4 ">📍 Contact Information</h3>

                        <div class="ratio ratio-16x9 mb-3 rounded">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d224345.839203315!2d77.0688998!3d28.5272803!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390d1c2a5c0ef88d%3A0x3c0f6fca18a9bced!2sDelhi!5e0!3m2!1sen!2sin!4v1611111111111"
                                style="border:0;" allowfullscreen="" loading="lazy" class="w-100 rounded"></iframe>
                        </div>

                        <ul class="list-unstyled">
                            <li class="mb-3"><i class="fas fa-map-marker-alt me-2 "></i> Lucknow, Uttar Pradesh, India
                            </li>
                            <li class="mb-3"><i class="fas fa-envelope me-2 "></i> support@roommitra.com
                            </li>
                            <li class="mb-3"><i class="fas fa-phone-alt me-2 "></i> +91-9305089318</li>
                            <li class="mb-3"><i class="fas fa-clock me-2 "></i> 24/7</li>
                        </ul>

                        <div class="mt-4">
                            <a href="#" class="me-3 text-dark"><i class="fab fa-facebook fa-lg"></i></a>
                            <a href="#" class="me-3 text-dark"><i class="fab fa-instagram fa-lg"></i></a>
                            <a href="#" class="me-3 text-dark"><i class="fab fa-linkedin fa-lg"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="col-lg-7">
                    <div class="bg-white p-4 p-md-5 rounded-4 animate__animated animate__fadeInRight">

                        <h3 class="fw-bold mb-4 ">Register Your Complaint</h3>
                        <form id="helpForm" method="post" enctype="multipart/form-data" class="needs-validation"
                            novalidate>

                            <div class="row g-3">

                                <!-- Name -->
                                <div class="col-md-6">
                                    <label for="name" class="form-label fw-bold">Full Name</label>
                                    <input type="text" class="form-control" id="name" name="name" required
                                        placeholder="Enter your full name">
                                    <div class="invalid-feedback">Name is required.</div>
                                </div>

                                <!-- Email -->
                                <div class="col-md-6">
                                    <label for="email" class="form-label fw-bold">Email</label>
                                    <input type="text" class="form-control" id="email" name="email" required
                                        placeholder="Email">
                                    <div class="invalid-feedback">Email or phone is required.</div>
                                </div>

                                {{-- phone --}}
                                <div class="col-md-6">
                                    <label for="phone" class="form-label fw-bold">Phone</label>
                                    <input type="text" class="form-control" id="phone" name="phone"
                                        placeholder="Phone number">
                                </div>
                                <!-- User Type -->
                                <div class="col-md-6">
                                    <label for="userType" class="form-label fw-bold">You Are *</label>
                                    <select class="form-select" id="userType" name="user_type" required>
                                        <option value="">Select User Type</option>
                                        <option value="guest">Guest</option>
                                        <option value="user">User</option>
                                        <option value="room_owner">Room Owner</option>

                                    </select>
                                    <div class="invalid-feedback">Please select user type.</div>
                                </div>

                                <!-- Help Category -->
                                <div class="col-md-6">
                                    <label for="category" class="form-label fw-bold">Help Category *</label>
                                    <select class="form-select" id="category" name="category" required>
                                        <option value="">Choose Category</option>
                                        <option>Room Booking</option>
                                        <option>Payments & Refunds</option>
                                        <option>Account Issues</option>
                                        <option>Complaints</option>
                                        <option>Documents</option>
                                        <option>Technical Support</option>
                                        <option>Other</option>
                                    </select>
                                    <div class="invalid-feedback fw-bold">Please select a help category.</div>
                                </div>

                                <!-- Subject -->
                                <div class="col-12">
                                    <label for="subject" class="form-label fw-bold">Subject *</label>
                                    <input type="text" class="form-control" id="subject" name="subject" required
                                        placeholder="Brief summary of your issue">
                                    <div class="invalid-feedback">Subject is required.</div>
                                </div>

                                <!-- Description -->
                                <div class="col-12">
                                    <label for="description" class="form-label fw-bold">Description *</label>
                                    <textarea class="form-control" id="description" name="description" rows="5" required
                                        placeholder="Please describe your issue in detail..."></textarea>
                                    <div class="invalid-feedback">Description is required.</div>
                                </div>

                                <!-- File Upload -->
                                <div class="col-12">
                                    <label for="file" class="form-label fw-bold">Upload Screenshot / File
                                        (Optional)</label>
                                    <input class="form-control" type="file" id="file" name="attachment[]"
                                        accept=".jpg,.jpeg,.png,.pdf,.doc,.docx" multiple>
                                    <div class="form-text">Supported formats: JPG, PNG, PDF, DOC</div>
                                </div>

                                <!-- Submit -->
                                <div class="col-12">
                                    <button type="submit" class="btn submit-btn btn-lg mt-2">Submit</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>


            <!-- FAQ Prompt -->
            <div class="row mt-5 text-center animate__animated animate__fadeInUp">
                <div class="col">
                    <p class="lead mb-0">
                        🤖 Need quick help? <a href="{{ route('faqs') }}" class=" fw-bold">Check our FAQs</a>

                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const form = document.getElementById('helpForm');

            form.addEventListener('submit', async (e) => {
                e.preventDefault();

                const formData = new FormData(form);
                const submitBtn = form.querySelector('button[type="submit"]');
                submitBtn.disabled = true;
                submitBtn.textContent = 'Submitting...';

                try {
                    const response = await fetch("{{ route('complaint.store') }}", {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: formData
                    });

                    const data = await response.json();

                    if (response.ok) {
                        alert(data.message || "Complaint submitted successfully!");
                        form.reset();
                    } else {
                        let errors = data.errors || {};
                        let messages = Object.values(errors).flat().join('\n');
                        alert(messages || "Something went wrong.");
                    }
                } catch (err) {
                    console.error(err);
                    alert("An error occurred. Please try again.");
                } finally {
                    submitBtn.disabled = false;
                    submitBtn.textContent = 'Submit';
                }
            });
        });
    </script>
@endpush
