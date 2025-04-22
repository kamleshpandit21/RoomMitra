@extends('layouts.app')
@section('title', 'Complaint')
@section('content')
    <section class="contact-us bg-light py-5" id="contact">
        <div class="container px-4 px-md-5">

            <!-- Page Title -->
            <h2 class="text-center mb-4 fw-bold display-5">👉 Need Help? We're Here For You!</h2>

            <!-- FAQ Accordion -->
            <div class="accordion mb-5 animate__animated animate__fadeInUp" id="faqAccordion">
                <h4 class="text-success mb-4 fw-bold">🙋 Frequently Asked Questions</h4>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="faq1">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapse1">
                            🏠 How can I book a room?
                        </button>
                    </h2>
                    <div id="collapse1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">Search for rooms, apply filters, select your desired room, and proceed
                            to book by providing your details and making payment.</div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="faq2">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapse2">
                            💳 What if my payment fails?
                        </button>
                    </h2>
                    <div id="collapse2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">In case of failed payment, the amount is usually refunded within 5-7
                            business days. If not, contact support with your transaction ID.</div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="faq3">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapse3">
                            🔑 I forgot my password. What should I do?
                        </button>
                    </h2>
                    <div id="collapse3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">Click on "Forgot Password" at login. Enter your registered email to
                            receive a reset link.</div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="faq4">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapse4">
                            📝 How do I file a complaint?
                        </button>
                    </h2>
                    <div id="collapse4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">You can lodge a complaint via the contact form below or through your
                            user dashboard in the 'Complaints' section.</div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="faq5">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapse5">
                            📄 Where do I upload my ID documents?
                        </button>
                    </h2>
                    <div id="collapse5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">After booking, go to your profile and upload your government-issued ID
                            under the ‘Documents’ tab.</div>
                    </div>
                </div>
            </div>

            <!-- Help Categories -->

            <h4 class="text-success mb-4 fw-bold">🙋 Help Categories</h4>
            <div class="row row-cols-1 row-cols-md-3 g-4 mb-5 animate__animated animate__fadeInUp">

                @php
                    $categories = [
                        [
                            'icon' => '🏘',
                            'title' => 'Room Booking',
                            'desc' => 'Issues with room search, booking, cancellation',
                        ],
                        [
                            'icon' => '💳',
                            'title' => 'Payments & Refunds',
                            'desc' => 'Failed payments, refund status, invoice help',
                        ],
                        [
                            'icon' => '👤',
                            'title' => 'Account Issues',
                            'desc' => 'Login, password reset, email/phone update',
                        ],
                        [
                            'icon' => '📤',
                            'title' => 'Complaints',
                            'desc' => 'Lodge a complaint regarding room or owner',
                        ],
                        [
                            'icon' => '📄',
                            'title' => 'Documents',
                            'desc' => 'ID upload, verification, document policies',
                        ],
                        [
                            'icon' => '🛠',
                            'title' => 'Technical Support',
                            'desc' => 'Website not loading, buttons not working etc',
                        ],
                    ];
                @endphp

                @foreach ($categories as $category)
                    <div class="col">
                        <div class="card h-100 shadow-sm border-0 rounded-4 p-3 bg-white">
                            <div class="card-body text-center">
                                <div class="fs-1 mb-3">{{ $category['icon'] }}</div>
                                <h5 class="card-title fw-bold text-success">{{ $category['title'] }}</h5>
                                <p class="card-text">{{ $category['desc'] }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Contact Section -->
            <div class="row g-5">

                <!-- Contact Info -->
                <div class="col-lg-5">
                    <div class="bg-white p-4 p-md-5 rounded-4 shadow h-100 animate__animated animate__fadeInLeft">
                        <h4 class="fw-bold mb-4 text-success">📍 Contact Information</h4>

                        <div class="ratio ratio-16x9 mb-3 rounded">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d224345.839203315!2d77.0688998!3d28.5272803!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390d1c2a5c0ef88d%3A0x3c0f6fca18a9bced!2sDelhi!5e0!3m2!1sen!2sin!4v1611111111111"
                                style="border:0;" allowfullscreen="" loading="lazy" class="w-100 rounded"></iframe>
                        </div>

                        <ul class="list-unstyled">
                            <li class="mb-3"><i class="fas fa-map-marker-alt me-2 text-success"></i> XYZ Nagar, Delhi,
                                India</li>
                            <li class="mb-3"><i class="fas fa-envelope me-2 text-success"></i> support@studentstay.com
                            </li>
                            <li class="mb-3"><i class="fas fa-phone-alt me-2 text-success"></i> +91-9876543210</li>
                            <li class="mb-3"><i class="fas fa-clock me-2 text-success"></i> Mon–Sat, 10 AM to 6 PM</li>
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
                    <div class="bg-white p-4 p-md-5 rounded-4 shadow animate__animated animate__fadeInRight">

                        <h4 class="fw-bold mb-4 text-success">📬 Send Us a Message</h4>
                        <form id="helpForm" method="post" enctype="multipart/form-data" class="needs-validation"
                            novalidate>

                            <div class="row g-3">

                                <!-- Name -->
                                <div class="col-md-6">
                                    <label for="name" class="form-label">👤 Full Name</label>
                                    <input type="text" class="form-control" id="name" name="name" required
                                        placeholder="Enter your full name">
                                    <div class="invalid-feedback">Name is required.</div>
                                </div>

                                <!-- Email -->
                                <div class="col-md-6">
                                    <label for="email" class="form-label">📧 Email</label>
                                    <input type="text" class="form-control" id="email" name="email" required
                                        placeholder="Email">
                                    <div class="invalid-feedback">Email or phone is required.</div>
                                </div>

                                {{-- phone --}}
                                <div class="col-md-6">
                                    <label for="phone" class="form-label">📞 Phone</label>
                                    <input type="text" class="form-control" id="phone" name="phone"
                                        placeholder="Phone number">
                                </div>
                                <!-- User Type -->
                                <div class="col-md-6">
                                    <label for="userType" class="form-label">🙋 You Are *</label>
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
                                    <label for="category" class="form-label">📂 Help Category *</label>
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
                                    <div class="invalid-feedback">Please select a help category.</div>
                                </div>

                                <!-- Subject -->
                                <div class="col-12">
                                    <label for="subject" class="form-label">📝 Subject *</label>
                                    <input type="text" class="form-control" id="subject" name="subject" required
                                        placeholder="Brief summary of your issue">
                                    <div class="invalid-feedback">Subject is required.</div>
                                </div>

                                <!-- Description -->
                                <div class="col-12">
                                    <label for="description" class="form-label">🧾 Description *</label>
                                    <textarea class="form-control" id="description" name="description" rows="5" required
                                        placeholder="Please describe your issue in detail..."></textarea>
                                    <div class="invalid-feedback">Description is required.</div>
                                </div>

                                <!-- File Upload -->
                                <div class="col-12">
                                    <label for="file" class="form-label">📎 Upload Screenshot / File
                                        (Optional)</label>
                                    <input class="form-control" type="file" id="file" name="attachment[]"
                                        accept=".jpg,.jpeg,.png,.pdf,.doc,.docx" multiple>
                                    <div class="form-text">Supported formats: JPG, PNG, PDF, DOC</div>
                                </div>

                                <!-- Submit -->
                                <div class="col-12">
                                    <button type="submit" class="btn btn-success btn-lg w-100 mt-2">🚀 Submit
                                        Request</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
            <h5 class="mt-5 fw-semibold">Our Support Hours</h5>
            <ul class="list-unstyled">
                <li>🕐 Monday to Friday: 9:00 AM – 6:00 PM</li>
                <li>📞 Emergency Support: 24/7</li>
            </ul>

            <!-- FAQ Prompt -->
            <div class="row mt-5 text-center animate__animated animate__fadeInUp">
                <div class="col">
                    <p class="lead mb-0">
                        🤖 Need quick help? <a href="{{ route('faqs') }}" class="text-success fw-bold">Check our FAQs</a>
                        or chat with our
                        <a href="#" class="text-success fw-bold">support bot</a>.
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
