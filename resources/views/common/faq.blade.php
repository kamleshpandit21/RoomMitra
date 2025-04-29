@extends('layouts.app')
@section('content')
    <section class="faq-section py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-4 fw-bold">❓ Frequently Asked Questions</h2>

            <!-- FAQ Categories -->
            <div class="accordion" id="faqAccordion">

                @forelse ($faqs as $category => $items)
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading-{{ Str::slug($category) }}">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapse-{{ Str::slug($category) }}">
                                🔹 {{ $category }}
                            </button>
                        </h2>
                        <div id="collapse-{{ Str::slug($category) }}" class="accordion-collapse collapse"
                            data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                @foreach ($items as $faq)
                                    <strong>{{ $faq->question }}</strong><br>
                                    {!! nl2br(e($faq->answer)) !!}
                                    @if (!$loop->last)
                                        <hr>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center">
                        No FAQs available at this time.</div>
                @endforelse


            </div>

            <!-- CTA -->
            <div class="text-center mt-5">
                <h5>Still have questions?</h5>
                <a href="/contact" class="btn btn-outline-primary mt-2">Contact Our Support Team</a>
            </div>
        </div>
    </section>
@endsection
