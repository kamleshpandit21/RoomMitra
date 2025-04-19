@extends('layouts.app')
@section('title', 'Contact')

@section('content')


<section class="text-center py-5 bg-light">
    <div class="container">
      <h1 class="mb-3">📞 Get in Touch</h1>
      <p class="text-muted">We usually respond within 24 hours. Feel free to reach out for any questions or support needs.</p>
    </div>
  </section>
<section class="contact-us bg-light py-5" id="contact">
    <div class="container px-4 px-md-5">
        <div class="row g-5">

            <!-- Contact Info -->
            <div class="col-lg-5">
                <div class="bg-white p-4 p-md-5 rounded-4  h-100 animate__animated animate__fadeInLeft">

                    <div class="ratio ratio-16x9 mb-3 rounded">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d224345.839203315!2d77.0688998!3d28.5272803!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390d1c2a5c0ef88d%3A0x3c0f6fca18a9bced!2sDelhi!5e0!3m2!1sen!2sin!4v1611111111111"
                            style="border:0;" allowfullscreen="" loading="lazy" class="w-100 rounded"></iframe>
                    </div>

                    <ul class="list-unstyled">
                        <li class="mb-3"><i class="fas fa-map-marker-alt me-2 text-success"></i> XYZ Nagar, Delhi, India</li>
                        <li class="mb-3"><i class="fas fa-envelope me-2 text-success"></i> support@studentstay.com</li>
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
                <div class="bg-white p-4 p-md-5 rounded-4  animate__animated animate__fadeInRight">

                    <form id="contactForm" novalidate>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label">Full Name *</label>
                                <input type="text" class="form-control" id="name" name="name" >
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email *</label>
                                <input type="email" class="form-control" id="email" name="email">
                            </div>
                            <div class="col-md-6">
                                <label for="phone" class="form-label">Phone Number *</label>
                                <input type="tel" class="form-control" id="phone" name="phone">
                            </div>
                            <div class="col-md-6">
                                <label for="subject" class="form-label">Subject *</label>
                                <select class="form-select" id="subject" name="subject">
                                    <option value="">Select...</option>
                                    <option value="general">General</option>
                                    <option value="complaint">Complaint</option>
                                    <option value="owner">Owner Query</option>
                                    <option value="partnership">Partnership</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label for="message" class="form-label">Message</label>
                                <textarea class="form-control" id="message" rows="5" name="message" ></textarea>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-success btn-lg w-100 mt-2">Submit</button>
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
                    🤖 Need quick help? <a href="{{route('faqs')}}" class="text-success fw-bold">Check our FAQs</a> or chat with our
                    <a href="#" class="text-success fw-bold">support bot</a>.
                </p>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    // Contact Form Validation
    document.getElementById('contactForm').addEventListener('submit', function (e) {
        if (!this.checkValidity()) {
            e.preventDefault();
            e.stopPropagation();
            alert("Please fill all  fields correctly!");
        }
        this.classList.add('was-validated');
    });
</script>
@endpush
