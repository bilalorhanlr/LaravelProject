<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        Setting::updateOrCreate(
            ['id' => 1],
            [
                'title' => 'Best buy E-Commerce',
                'keywords' => 'ecommerce, shop, fashion, electronics',
                'description' => 'Your trusted online shopping destination.',
                'company' => 'E-SHOP Ltd.',
                'address' => '123 Commerce Street, London, UK',
                'phone' => '+44 20 1234 5678',
                'email' => 'info@e-shop.com',
                'facebook' => 'https://facebook.com',
                'instagram' => 'https://instagram.com',
                'twitter' => 'https://twitter.com',
                'aboutus' => "E-SHOP is a modern e-commerce destination offering curated fashion, electronics, and lifestyle products.\n\nWe believe in quality, transparency, and exceptional customer experience. Founded with a passion for design and innovation, we partner with trusted brands to bring you the best products at competitive prices.",
                'contact' => "Headquarters\nOur global headquarters are in the UK. We also have a significant presence in the USA and regional headquarters in Singapore.\n\nIntegrity and compliance\nWe respond to all contact form messages within 24 business hours.",
                'references' => 'Trusted by thousands of customers worldwide.',
                'status' => 'active',
            ]
        );
    }
}
