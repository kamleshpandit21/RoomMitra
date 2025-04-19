@extends('layouts.app')
@section('content')


<section class="faq-section py-5 bg-light">
    <div class="container">
      <h2 class="text-center mb-4 fw-bold">❓ Frequently Asked Questions</h2>
  
      <!-- FAQ Categories -->
      <div class="accordion" id="faqAccordion">
        
        <!-- 1. General Questions -->
        <div class="accordion-item">
          <h2 class="accordion-header" id="headingGeneral">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseGeneral" aria-expanded="true">
              🔹 General Questions
            </button>
          </h2>
          <div id="collapseGeneral" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
            <div class="accordion-body">
              <strong>What is StudentStay?</strong><br>
              It’s an online platform that connects students looking for accommodation with verified room owners across various cities.
              <hr>
              <strong>Is it free to use?</strong><br>
              Yes! Creating an account and browsing rooms is absolutely free.
              <hr>
              <strong>How do I contact support?</strong><br>
              Use the Contact Us page or email us at <a href="mailto:support@example.com">support@example.com</a>.
            </div>
          </div>
        </div>
  
        <!-- 2. For Students -->
        <div class="accordion-item">
          <h2 class="accordion-header" id="headingStudents">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseStudents">
              🔹 For Students (Users)
            </button>
          </h2>
          <div id="collapseStudents" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
            <div class="accordion-body">
              <strong>🏠 How can I search for rooms?</strong><br>
              Simply use our homepage search or browse by city. You can filter by price, amenities, and more.
              <hr>
              <strong>💳 Do I have to pay online?</strong><br>
              Payment options depend on the room owner. You’ll see available methods at the time of booking.
              <hr>
              <strong>📅 Can I cancel a booking?</strong><br>
              Yes, cancellation policies vary by owner. Check the room details before booking.
              <hr>
              <strong>👤 How do I update my profile?</strong><br>
              Go to Profile → Edit from the top-right menu after login.
              <hr>
              <strong>⭐ How are rooms verified?</strong><br>
              We verify owner details before approving room listings for trust and safety.
            </div>
          </div>
        </div>
  
        <!-- 3. For Room Owners -->
        <div class="accordion-item">
          <h2 class="accordion-header" id="headingOwners">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOwners">
              🔹 For Room Owners
            </button>
          </h2>
          <div id="collapseOwners" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
            <div class="accordion-body">
              <strong>🏘️ How can I list a room?</strong><br>
              Register as a Room Owner → Login → Go to Manage Rooms → Add Room.
              <hr>
              <strong>🛡️ How do I get verified?</strong><br>
              Upload your Aadhar/PAN details and wait for admin approval. You’ll be notified by email.
              <hr>
              <strong>💼 Can I manage multiple rooms?</strong><br>
              Absolutely! You can add, edit, or remove multiple listings from your dashboard.
              <hr>
              <strong>💰 How do I receive payments?</strong><br>
              You’ll set your preferred payment method while listing the room (UPI, Bank transfer, etc.).
            </div>
          </div>
        </div>
  
        <!-- 4. Security & Verification -->
        <div class="accordion-item">
          <h2 class="accordion-header" id="headingSecurity">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSecurity">
              🔹 Security & Verification
            </button>
          </h2>
          <div id="collapseSecurity" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
            <div class="accordion-body">
              <strong>🔒 Is my data safe?</strong><br>
              Yes, we use encryption and secure servers to protect your data.
              <hr>
              <strong>🧾 How do you verify room owners?</strong><br>
              They must provide valid identity and address proof which is reviewed manually by our team.
              <hr>
              <strong>❗ I saw a suspicious listing. What should I do?</strong><br>
              Please report it using the Report button on the room page or contact our team.
            </div>
          </div>
        </div>
  
        <!-- 5. Technical Questions -->
        <div class="accordion-item">
          <h2 class="accordion-header" id="headingTechnical">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTechnical">
              🔹 Technical Questions
            </button>
          </h2>
          <div id="collapseTechnical" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
            <div class="accordion-body">
              <strong>📱 Is there a mobile app?</strong><br>
              (Future Feature) Currently, our website is fully mobile responsive. An app is coming soon!
              <hr>
              <strong>🚫 I'm facing login issues. What should I do?</strong><br>
              Try resetting your password or contact support at <a href="mailto:login-help@example.com">login-help@example.com</a>.
              <hr>
              <strong>📧 I didn’t receive a confirmation email.</strong><br>
              Please check spam/junk folder. Still nothing? Contact our support.
            </div>
          </div>
        </div>
      </div>
  
      <!-- CTA -->
      <div class="text-center mt-5">
        <h5>Still have questions?</h5>
        <a href="/contact" class="btn btn-outline-primary mt-2">Contact Our Support Team</a>
      </div>
    </div>
  </section>
@endsection