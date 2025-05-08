@extends('layouts.app')
@section('title', 'Contact Us')

<style>
    .submit-btn {
        border: 2px solid #6366f1 !important;
        color: #6366f1 !important;
        transition: all 0.3s ease-in-out;
    }
    .submit-btn:hover {
        background-color: #6366f1 !important;
        border: 2px solid #6366f1 !important;
        color: #fff !important;
    }
</style>

@section('content')

    <section class="text-center bg-light" style="padding-top: 160px;">
        <div class="container">
            <h1 class="display-5 fw-bold mb-3 heading">Contact Us</h1>
            <p class="text-muted">
                We typically respond within 24 hours. Please feel free to reach out for any inquiries, support needs, or feedback.
            </p>
        </div>
    </section>

    <section class="contact-us bg-light py-5" id="contact">
        <div class="container px-4 px-md-5">
            <div class="row g-5">

                <!-- Contact Information -->
                <div class="col-lg-5">
                    <div class="bg-white p-4 p-md-5 rounded-4 h-100 animate__animated animate__fadeInLeft">

                        <div class="ratio ratio-16x9 mb-3 rounded">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d224345.839203315!2d77.0688998!3d28.5272803!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390d1c2a5c0ef88d%3A0x3c0f6fca18a9bced!2sDelhi!5e0!3m2!1sen!2sin!4v1611111111111"
                                style="border:0;" allowfullscreen="" loading="lazy" class="w-100 rounded"></iframe>
                        </div>

                        <ul class="list-unstyled">
                            <li class="mb-3">
                                <i class="fas fa-map-marker-alt me-2 text-success"></i>
                                Lucknow, Uttar Pradesh, India
                            </li>
                            <li class="mb-3">
                                <i class="fas fa-envelope me-2 text-success"></i>
                                support@roommitra.com
                            </li>
                            <li class="mb-3">
                                <i class="fas fa-phone-alt me-2 text-success"></i>
                                +91-9305089318
                            </li>
                            <li class="mb-3">
                                <i class="fas fa-clock me-2 text-success"></i>
                                24/7
                            </li>
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
                        <form id="contactForm" novalidate>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="name" class="form-label">Full Name *</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email Address *</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="phone" class="form-label">Phone Number *</label>
                                    <input type="tel" class="form-control" id="phone" name="phone" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="subject" class="form-label">Subject *</label>
                                    <select class="form-select" id="subject" name="subject" required>
                                        <option value="">Select...</option>
                                        <option value="general">General Inquiry</option>
                                        <option value="complaint">Complaint</option>
                                        <option value="owner">Owner Query</option>
                                        <option value="partnership">Partnership</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label for="message" class="form-label">Message</label>
                                    <textarea class="form-control" id="message" rows="5" name="message"></textarea>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn submit-btn btn-lg">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>

            <!-- FAQ and Bot Prompt -->
            <div class="row mt-5 text-center animate__animated animate__fadeInUp">
                <div class="col">
                    <p class="lead mb-0">
                        🤖 Looking for quick answers? Visit our 
                        <a href="{{ route('faqs') }}" class="text-success fw-bold">FAQs</a> 
                    </p>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const form = document.getElementById('contactForm');

        form.addEventListener('submit', async (e) => {
            e.preventDefault();

            const formData = new FormData(form);
            const submitBtn = form.querySelector('button[type="submit"]');
            submitBtn.disabled = true;
            submitBtn.textContent = 'Submitting...';

            try {
                const response = await fetch("{{ route('contact.store') }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: formData
                });

                const data = await response.json();

                if (response.ok) {
                    alert(data.message || "Your message has been submitted successfully.");
                    form.reset();
                } else {
                    const errors = data.errors || {};
                    const messages = Object.values(errors).flat().join('\n');
                    alert(messages || "An error occurred while submitting the form.");
                }
            } catch (error) {
                console.error(error);
                alert("Unexpected error. Please try again later.");
            } finally {
                submitBtn.disabled = false;
                submitBtn.textContent = 'Submit';
            }
        });
    });
</script>
@endpush
