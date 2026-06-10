<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        $faqs = [
            ['How long does shipping take?', 'Standard shipping takes 3-5 business days. Express shipping is available at checkout for 1-2 day delivery.'],
            ['What is your return policy?', 'We offer 30-day hassle-free returns on all unused items in original packaging. Contact support to initiate a return.'],
            ['Do you ship internationally?', 'Yes, we ship to over 50 countries worldwide. International delivery times vary by destination.'],
            ['How can I track my order?', 'Once shipped, you will receive a tracking number via email. You can also view order status in your account.'],
            ['What payment methods do you accept?', 'We accept Visa, Mastercard, PayPal, and bank transfer for selected regions.'],
            ['How do I contact customer support?', 'Use our Contact Us page or email support@e-shop.com. We respond within 24 business hours.'],
        ];

        foreach ($faqs as [$question, $answer]) {
            Faq::firstOrCreate(
                ['question' => $question],
                ['answer' => $answer, 'status' => 'active']
            );
        }
    }
}
