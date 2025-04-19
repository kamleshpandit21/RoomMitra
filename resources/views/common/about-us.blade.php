@extends('layouts.app')
@section('title', 'About Us')
@section('content')
<style>
  .gallery {
      column-width: 400px;
      column-gap: 1rem;
  }

  .gallery img {
      width: 100%;
      height: auto;
      margin-bottom: 1rem;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      transition: transform 0.3s ease;
  }

  .gallery img:hover {
      transform: scale(1.03);
  }

  section.about-us h2, section.about-us h3 {
      margin-bottom: 1rem;
  }

  .timeline-item {
      text-align: center;
      padding: 1rem;
      background: #f8f9fa;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.05);
      margin: 0.5rem;
  }

  .table-responsive {
      max-width: 800px;
      margin: auto;
  }
</style>

<section class="about-us py-5 bg-light" id="about">
    <div class="container">

      <!-- Our Story -->
      <div class="row align-items-center mb-5" data-aos="fade-up">
        <div class="col-lg-6 mb-3 mb-lg-0">
          <img src="{{ asset('img/Founding-team.jpg') }}" alt="Our Story" class="img-fluid rounded shadow">
        </div>
        <div class="col-lg-6">
          <h2 class="fw-bold">It All Started with a Struggle</h2>
          <p class="lead">“Finding a decent room during my first semester was like a second entrance exam. That’s when we thought — <strong>students deserve better</strong>.”</p>
        </div>
      </div>
<!-- What Makes Us Different -->
<div class="text-center mb-5" data-aos="fade-up">
  <h3 class="fw-bold mb-4">What Makes StudentRoom Stand Out?</h3>
  <div class="table-responsive">
    <table class="table table-bordered table-striped align-middle text-center shadow-sm">
      <thead class="table-primary">
        <tr class="align-middle">
          <th>Feature</th>
          <th><i class="fa fa-building text-muted"></i> Others</th>
          <th><i class="fa fa-user-graduate text-success"></i> StudentRoom</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><i class="fa fa-shield-alt text-success me-2"></i>Verified Listings</td>
          <td><span class="text-danger fs-4">✖</span></td>
          <td><span class="text-success fs-4">✔</span></td>
        </tr>
        <tr>
          <td><i class="fa fa-money-bill-wave text-success me-2"></i>No Brokerage</td>
          <td><span class="text-danger fs-4">✖</span></td>
          <td><span class="text-success fs-4">✔</span></td>
        </tr>
        <tr>
          <td><i class="fa fa-users text-success me-2"></i>Student-Focused Listings</td>
          <td><span class="text-danger fs-4">✖</span></td>
          <td><span class="text-success fs-4">✔</span></td>
        </tr>
        <tr>
          <td><i class="fa fa-headset text-success me-2"></i>Complaint Redressal</td>
          <td><span class="text-danger fs-4">✖</span></td>
          <td><span class="text-success fs-4">✔</span></td>
        </tr>
        <tr>
          <td><i class="fa fa-clock text-success me-2"></i>Timely Availability</td>
          <td><span class="text-danger fs-4">✖</span></td>
          <td><span class="text-success fs-4">✔</span></td>
        </tr>
        <tr>
          <td><i class="fa fa-map-marked-alt text-success me-2"></i>Nearby Essentials Mapped</td>
          <td><span class="text-danger fs-4">✖</span></td>
          <td><span class="text-success fs-4">✔</span></td>
        </tr>
        <tr>
          <td><i class="fa fa-heart text-success me-2"></i>Wishlist & Shortlist Options</td>
          <td><span class="text-danger fs-4">✖</span></td>
          <td><span class="text-success fs-4">✔</span></td>
        </tr>
      </tbody>
    </table>
  </div>
</div>


     <!-- Timeline -->
<div class="mb-5" data-aos="fade-up">
  <h3 class="fw-bold text-center mb-4">Our Journey So Far</h3>
  <div class="row justify-content-center gy-4">
    <div class="col-md-3 text-center">
      <div class="p-3 border rounded shadow-sm h-100 hover-shadow">
        <h5 class="mb-2">💡 Aug 2023</h5>
        <p class="mb-0">The idea took shape in a hostel room — a solution to make student accommodation stress-free.</p>
      </div>
    </div>
    <div class="col-md-3 text-center">
      <div class="p-3 border rounded shadow-sm h-100 hover-shadow">
        <h5 class="mb-2">🧑‍💻 Nov 2024</h5>
        <p class="mb-0">Our team began building the platform with a student-first mindset and modern tech stack.</p>
      </div>
    </div>
    <div class="col-md-3 text-center">
      <div class="p-3 border rounded shadow-sm h-100 hover-shadow">
        <h5 class="mb-2">🧪 Jan 2025</h5>
        <p class="mb-0">Prototype tested with real users. Feedback helped us polish core features and flows.</p>
      </div>
    </div>
    <div class="col-md-3 text-center">
      <div class="p-3 border rounded shadow-sm h-100 hover-shadow">
        <h5 class="mb-2">🚀 Coming Soon</h5>
        <p class="mb-0">Final version almost ready. We’re preparing for launch — stay tuned!</p>
      </div>
    </div>
  </div>
</div>

     <!-- Values -->
<div class="text-center mb-5" data-aos="fade-up">
  <h3 class="fw-bold mb-4">Our Core Values</h3>
  <p class="text-muted mb-4">What drives us every day to build a better experience for students like us.</p>
  <div class="row mt-4 gy-4">
    <div class="col-md-3">
      <i class="fas fa-heart fa-2x text-success mb-2"></i>
      <p><strong>Empathy</strong><br>We know the student life — because we’ve lived it. Our platform is built with that understanding.</p>
    </div>
    <div class="col-md-3">
      <i class="fas fa-shield-alt fa-2x text-success mb-2"></i>
      <p><strong>Safety First</strong><br>Verified owners, secure listings, and transparent details — because peace of mind matters.</p>
    </div>
    <div class="col-md-3">
      <i class="fas fa-magic fa-2x text-success mb-2"></i>
      <p><strong>Simplicity</strong><br>We remove the mess — so students can find rooms without stress or confusion.</p>
    </div>
    <div class="col-md-3">
      <i class="fas fa-hands-helping fa-2x text-success mb-2"></i>
      <p><strong>Community</strong><br>A space where students help each other — from room reviews to local tips.</p>
    </div>
  </div>
</div>


      <!-- Active Cities -->
      <div class="text-center mb-5" data-aos="fade-up">
        <h3 class="fw-bold mb-4">Where We’re Active</h3>
        <div class="d-flex flex-wrap justify-content-center gap-4">
          <span class="badge bg-success p-3 fs-5">📍 Lucknow</span>
          <span class="badge bg-secondary p-3 fs-5">More Cities Coming Soon...</span>
        </div>
      </div>

      <!-- Behind the Scenes -->
      <div class="mb-5" data-aos="fade-up">
        <h3 class="fw-bold text-center mb-4">Behind the Scenes</h3>
        <div class="gallery">
          <img src="{{ asset('img/design-team.webp') }}" alt="Designing">
          <img src="{{ asset('img/House-visit.jpg') }}" alt="House Visit">
          <img src="{{ asset('img/Website-planning.jpg') }}" alt="Website Planning">
          <img src="{{ asset('img/Business-meeting.jpg') }}" alt="Business Meeting">
          <img src="{{ asset('img/Coleage.jpg') }}" alt="College">
          <img src="{{ asset('img/Hostel-Inspection.jpg') }}" alt="Hostel Inspection">
        </div>
      </div>
<!-- Join Us -->
<div class="text-center mb-5" data-aos="fade-up">
  <h3 class="fw-bold">Want to Join Us?</h3>
  <p class="lead">We’re just getting started — and you could be a part of this journey.</p>
  <p class="text-muted mb-3">Whether you want to gain experience, build something impactful, or just help fellow students — there’s a place for you here.</p>
  <div class="d-flex justify-content-center gap-3 flex-wrap mb-3">
    <span class="badge bg-primary fs-6 p-2">Interns</span>
    <span class="badge bg-warning fs-6 p-2">Campus Ambassadors</span>
    <span class="badge bg-success fs-6 p-2">Volunteers</span>
  </div>
  <a href="" class="btn btn-dark">Join the Mission</a>
</div>


    </div>
</section>
@endsection

@push('scripts')
<script>
  const counters = document.querySelectorAll(".counter");
  const speed = 200;

  const animateCounters = () => {
    counters.forEach((counter) => {
      const updateCount = () => {
        const target = +counter.getAttribute("data-target");
        const count = +counter.innerText;
        const inc = Math.ceil(target / speed);

        if (count < target) {
          counter.innerText = count + inc;
          setTimeout(updateCount, 30);
        } else {
          counter.innerText = target + "+";
        }
      };
      updateCount();
    });
  };

  let started = false;
  window.addEventListener("scroll", () => {
    const statsSection = document.getElementById("stats");
    if (!statsSection) return;
    const sectionTop = statsSection.getBoundingClientRect().top;
    const screenHeight = window.innerHeight;

    if (!started && sectionTop < screenHeight) {
      started = true;
      animateCounters();
    }
  });
</script>
@endpush