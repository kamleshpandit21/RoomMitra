@extends('layouts.app')

@section('title', 'Frequently Asked Questions')
@section('content')

    <section class="faq-section bg-light" style="padding: 160px 0 80px 0; ">
        <div class="container">
            <h2 class="text-center mb-4 fw-bold heading">❓ Frequently Asked Questions</h2>

            <!-- FAQ Categories -->
            <div class="accordion" id="faqAccordion">
                @forelse ($faqs as $category => $items)
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading-{{ Str::slug($category) }}">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapse-{{ Str::slug($category) }}" aria-expanded="false"
                                aria-controls="collapse-{{ Str::slug($category) }}">
                                🔹 {{ $category }}
                            </button>
                        </h2>
                        <div id="collapse-{{ Str::slug($category) }}" class="accordion-collapse collapse"
                            data-bs-parent="#faqAccordion" aria-labelledby="heading-{{ Str::slug($category) }}">
                            <div class="accordion-body">
                                @foreach ($items as $faq)
                                    <div class="mb-3">
                                        <strong class="d-block">{{ $faq->question }}</strong>
                                        <p class="mb-0">{!! nl2br(e($faq->answer)) !!}</p>
                                    </div>
                                    @if (!$loop->last)
                                        <hr>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-4">
                        <p class="text-muted">No FAQs available at this time. Please check back later.</p>
                    </div>
                @endforelse
            </div>

            <!-- Call to Action -->
            <div class="text-center mt-5">
                <h5>Still have questions?</h5>
                <a href="{{ route('contact.form') }}" class="btn btn-outline-primary mt-2">Contact Our Support Team</a>
            </div>
        </div>
    </section>

@endsection
