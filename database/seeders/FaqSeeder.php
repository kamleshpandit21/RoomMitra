<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    
      
        $data = [
            // General Questions
            ['category' => 'General Questions', 'question' => 'What is StudentStay?', 'answer' => 'It’s an online platform that connects students looking for accommodation with verified room owners.'],
            ['category' => 'General Questions', 'question' => 'Is StudentStay free to use?', 'answer' => 'Yes, browsing and registering is completely free for students.'],
            ['category' => 'General Questions', 'question' => 'Which cities are available?', 'answer' => 'We are currently live in over 20 cities across India.'],
            ['category' => 'General Questions', 'question' => 'How to contact support?', 'answer' => 'You can email support@example.com or use the Contact Us page.'],

            // For Students
            ['category' => 'For Students (Users)', 'question' => 'How can I search for rooms?', 'answer' => 'Use the homepage search or browse by city with filters like price, amenities, etc.'],
            ['category' => 'For Students (Users)', 'question' => 'Can I cancel a booking?', 'answer' => 'Yes, but cancellation policy depends on the room owner.'],
            ['category' => 'For Students (Users)', 'question' => 'How do I update my profile?', 'answer' => 'Login and go to Profile → Edit.'],
            ['category' => 'For Students (Users)', 'question' => 'Are all listings verified?', 'answer' => 'Yes, we manually verify all room listings.'],

            // For Room Owners
            ['category' => 'For Room Owners', 'question' => 'How do I list my room?', 'answer' => 'Register as Room Owner → Login → Manage Rooms → Add Room.'],
            ['category' => 'For Room Owners', 'question' => 'Can I list multiple rooms?', 'answer' => 'Yes, you can manage multiple rooms from your dashboard.'],
            ['category' => 'For Room Owners', 'question' => 'How are owners verified?', 'answer' => 'By uploading valid ID and address proof.'],
            ['category' => 'For Room Owners', 'question' => 'How do I get paid?', 'answer' => 'Set your payment method while listing — UPI, Bank Transfer, etc.'],

            // Security & Verification
            ['category' => 'Security & Verification', 'question' => 'Is my data safe?', 'answer' => 'Yes, all data is encrypted and securely stored.'],
            ['category' => 'Security & Verification', 'question' => 'How are rooms verified?', 'answer' => 'Rooms are listed only after ID and address check of owner.'],
            ['category' => 'Security & Verification', 'question' => 'How to report a suspicious listing?', 'answer' => 'Use the Report button or contact support directly.'],
            ['category' => 'Security & Verification', 'question' => 'Are transactions safe?', 'answer' => 'We suggest secure methods and never store payment details.'],

            // Technical Questions
            ['category' => 'Technical Questions', 'question' => 'Is there a mobile app?', 'answer' => 'Coming soon! Meanwhile, the website is fully responsive.'],
            ['category' => 'Technical Questions', 'question' => 'I’m facing login issues.', 'answer' => 'Try resetting password or contact login-help@example.com.'],
            ['category' => 'Technical Questions', 'question' => 'Didn’t receive confirmation email.', 'answer' => 'Check spam/junk folder or contact support.'],
            ['category' => 'Technical Questions', 'question' => 'Can I use the platform on mobile?', 'answer' => 'Yes, the website is mobile-optimized.']
        ];


        foreach ($data as $faq) {
            Faq::create($faq);
        }
    }
}
