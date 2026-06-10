<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        $faqs = [
            [
                'question' => 'How long does shipping take?',
                'answer' => 'Standard shipping takes 3-5 business days. Express shipping is available at checkout for 1-2 business day delivery.',
            ],
            [
                'question' => 'What is your return policy?',
                'answer' => 'We offer 30-day hassle-free returns on all unused items in original packaging. Contact our support team to initiate a return.',
            ],
            [
                'question' => 'Do you ship internationally?',
                'answer' => 'Yes, we ship to over 50 countries worldwide. International shipping times vary by destination.',
            ],
            [
                'question' => 'How can I track my order?',
                'answer' => 'Once your order ships, you will receive a tracking number via email. You can also view order status in your account dashboard.',
            ],
            [
                'question' => 'What payment methods do you accept?',
                'answer' => 'We accept major credit cards, debit cards, PayPal, and bank transfers depending on your region.',
            ],
            [
                'question' => 'How do product reviews work?',
                'answer' => 'Anyone can leave a star rating and review on product pages. Reviews are published immediately and help other shoppers make informed decisions.',
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::firstOrCreate(
                ['question' => $faq['question']],
                ['answer' => $faq['answer'], 'status' => 'active']
            );
        }
    }
}
