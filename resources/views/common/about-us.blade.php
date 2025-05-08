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

  .table-responsive {
      max-width: 900px;
      margin: auto;
  }

  .hover-shadow:hover {
      box-shadow: 0 8px 16px rgba(0,0,0,0.1);
      transition: box-shadow 0.3s ease;
  }

  section.about-us h2, section.about-us h3 {
      font-weight: 700;
      margin-bottom: 1rem;
  }
</style>

<section class="about-us bg-light " id="about" style="padding: 160px 0 80px 0">
    <div class="container">

        <!-- Our Story -->
        <div class="row align-items-center mb-5" data-aos="fade-up">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <img src="{{ asset('img/Founding-team.jpg') }}" alt="Founding team discussing ideas" class="img-fluid rounded shadow">
            </div>
            <div class="col-lg-6">
                <h2>It All Started with a Struggle</h2>
                <p class="lead text-muted">“Finding a decent room during my first semester was like a second entrance exam. That’s when we thought — <strong>students deserve better</strong>.”</p>
            </div>
        </div>

        <!-- What Makes Us Different -->
        <div class="text-center mb-5" data-aos="fade-up">
            <h3 class="display-5 fw-bold mb-3 heading">What Makes StudentRoom Stand Out?</h3>
            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle text-center shadow-sm">
                    <thead class="table-primary">
                        <tr>
                            <th>Feature</th>
                            <th><i class="fa fa-building text-muted"></i> Others</th>
                            <th><i class="fa fa-user-graduate text-success"></i> StudentRoom</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                          $features = [
                            ['Verified Listings', true],
                            ['No Brokerage', true],
                            ['Student-Focused Listings', true],
                            ['Complaint Redressal', true],
                            ['Timely Availability', true],
                            ['Nearby Essentials Mapped', true],
                            ['Wishlist & Shortlist Options', true],
                          ];
                        @endphp
                        @foreach ($features as $feature)
                        <tr>
                            <td><i class="fa fa-check-circle text-success me-2"></i>{{ $feature[0] }}</td>
                            <td><span class="text-danger fs-4">✖</span></td>
                            <td><span class="text-success fs-4">✔</span></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Our Journey -->
        <div class="mb-5" data-aos="fade-up">
            <h3 class="display-5 fw-bold mb-3 heading">Our Journey So Far</h3>
            <div class="row justify-content-center gy-4">
                @php
                    $timeline = [
                        ['💡 Aug 2023', 'The idea took shape in a hostel room — a solution to make student accommodation stress-free.'],
                        ['🧑‍💻 Nov 2024', 'Our team began building the platform with a student-first mindset and modern tech stack.'],
                        ['🧪 Jan 2025', 'Prototype tested with real users. Feedback helped us polish core features and flows.'],
                        ['🚀 Coming Soon', 'Final version almost ready. We’re preparing for launch — stay tuned!']
                    ];
                @endphp
                @foreach($timeline as [$date, $desc])
                <div class="col-md-3 text-center">
                    <div class="p-3 border rounded shadow-sm h-100 hover-shadow">
                        <h5 class="mb-2">{{ $date }}</h5>
                        <p class="mb-0 text-muted">{{ $desc }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Core Values -->
        <div class="text-center mb-5" data-aos="fade-up">
            <h3 class="display-5 fw-bold mb-3 heading">Our Core Values</h3>
            <p class="text-muted mb-4">What drives us every day to build a better experience for students like us.</p>
            <div class="row mt-4 gy-4">
                @php
                    $values = [
                        ['Empathy', 'fa-heart', 'We know the student life — because we’ve lived it.'],
                        ['Safety First', 'fa-shield-alt', 'Verified owners, secure listings, and transparency.'],
                        ['Simplicity', 'fa-magic', 'We remove the mess — so students can find rooms without stress.'],
                        ['Community', 'fa-hands-helping', 'A space where students help each other — from room reviews to local tips.']
                    ];
                @endphp
                @foreach ($values as [$title, $icon, $desc])
                <div class="col-md-3">
                    <i class="fas {{ $icon }} fa-2x text-success mb-2"></i>
                    <p><strong>{{ $title }}</strong><br>{{ $desc }}</p>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Cities -->
        <div class="text-center mb-5" data-aos="fade-up">
            <h3 class="display-5 fw-bold mb-3 heading">Where We’re Active</h3>
            <div class="d-flex flex-wrap justify-content-center gap-4 mt-3">
                <span class="badge bg-success p-3 fs-5">📍 Lucknow</span>
                <span class="badge bg-secondary p-3 fs-5">More Cities Coming Soon...</span>
            </div>
        </div>

        <!-- Gallery -->
        <div class="mb-5" data-aos="fade-up">
            <h3 class="display-5 fw-bold mb-3 heading">Behind the Scenes</h3>
            <div class="gallery">
                @foreach (['Founding-team', 'House-visit', 'Website-planning', 'Business-meeting', 'Coleage', 'Hostel-Inspection'] as $img)
                    <img src="{{ asset("img/{$img}.jpg") }}" alt="{{ str_replace('-', ' ', ucfirst($img)) }}">
                @endforeach
            </div>
        </div>

        <!-- Join Us -->
        <div class="text-center mb-5" data-aos="fade-up">
            <h3 class="display-5 fw-bold mb-3 heading">Want to Join Us?</h3>
            <p class="lead">We’re just getting started — and you could be a part of this journey.</p>
            <p class="text-muted mb-3">Whether you want to gain experience, build something impactful, or help fellow students — there’s a place for you here.</p>
            <div class="d-flex justify-content-center gap-3 flex-wrap mb-4">
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

@endpush
