<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'category' => 'bags-shoes',
                'name' => 'Urban Runner Sneakers',
                'price' => 32.50,
                'original_price' => 45.00,
                'image' => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=600&h=600&fit=crop',
                'rating' => 4.0,
                'review_count' => 3,
                'is_new' => true,
                'discount_percent' => 20,
                'stock' => 24,
                'sizes' => ['S', 'M', 'L', 'XL'],
                'colors' => ['#3B82F6', '#7F1D1D', '#6B21A8', '#C4B5FD'],
                'is_featured' => true,
                'is_deal' => true,
            ],
            [
                'category' => 'bags-shoes',
                'name' => 'Leather Crossbody Bag',
                'price' => 58.00,
                'original_price' => 72.00,
                'image' => 'https://images.unsplash.com/photo-1548036328-c9fa89d6e08d?w=600&h=600&fit=crop',
                'rating' => 4.5,
                'review_count' => 12,
                'is_new' => true,
                'discount_percent' => 20,
                'stock' => 15,
                'sizes' => ['One Size'],
                'colors' => ['#78350F', '#1F2937'],
                'is_featured' => true,
            ],
            [
                'category' => 'jewelry-watches',
                'name' => 'Minimalist Steel Watch',
                'price' => 89.99,
                'original_price' => 120.00,
                'image' => 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=600&h=600&fit=crop',
                'rating' => 5.0,
                'review_count' => 8,
                'is_new' => false,
                'discount_percent' => 25,
                'stock' => 10,
                'sizes' => ['Standard'],
                'colors' => ['#374151', '#D97706'],
                'is_featured' => true,
            ],
            [
                'category' => 'bags-shoes',
                'name' => 'Classic Leather Wallet',
                'price' => 24.50,
                'original_price' => null,
                'image' => 'https://images.unsplash.com/photo-1627123424574-724758594e93?w=600&h=600&fit=crop',
                'rating' => 4.0,
                'review_count' => 5,
                'is_new' => true,
                'discount_percent' => null,
                'stock' => 40,
                'sizes' => ['Standard'],
                'colors' => ['#451A03', '#1C1917'],
                'is_featured' => true,
            ],
            [
                'category' => 'womens-clothing',
                'name' => 'Silk Evening Dress',
                'price' => 64.00,
                'original_price' => 80.00,
                'image' => 'https://images.unsplash.com/photo-1595777457583-95e059d581b8?w=600&h=600&fit=crop',
                'rating' => 4.5,
                'review_count' => 18,
                'is_new' => false,
                'discount_percent' => 20,
                'stock' => 8,
                'sizes' => ['S', 'M', 'L'],
                'colors' => ['#BE123C', '#1E3A8A', '#000000'],
                'is_deal' => true,
            ],
            [
                'category' => 'mens-clothing',
                'name' => 'Premium Cotton Shirt',
                'price' => 39.99,
                'original_price' => 49.99,
                'image' => 'https://images.unsplash.com/photo-1596755094514-f87e34085b2c?w=600&h=600&fit=crop',
                'rating' => 4.0,
                'review_count' => 22,
                'is_new' => true,
                'discount_percent' => 20,
                'stock' => 30,
                'sizes' => ['S', 'M', 'L', 'XL', 'XXL'],
                'colors' => ['#FFFFFF', '#1E40AF', '#14532D'],
                'is_deal' => true,
            ],
            [
                'category' => 'consumer-electronics',
                'name' => 'Wireless Noise-Cancel Headphones',
                'price' => 129.00,
                'original_price' => 179.00,
                'image' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=600&h=600&fit=crop',
                'rating' => 4.8,
                'review_count' => 45,
                'is_new' => true,
                'discount_percent' => 28,
                'stock' => 20,
                'sizes' => ['One Size'],
                'colors' => ['#111827', '#F3F4F6'],
                'is_featured' => true,
                'is_deal' => true,
            ],
            [
                'category' => 'phones-accessories',
                'name' => 'MagSafe Phone Case',
                'price' => 19.99,
                'original_price' => 29.99,
                'image' => 'https://images.unsplash.com/photo-1601784551446-20c9e07cdbdb?w=600&h=600&fit=crop',
                'rating' => 4.2,
                'review_count' => 31,
                'is_new' => false,
                'discount_percent' => 33,
                'stock' => 50,
                'sizes' => ['Standard'],
                'colors' => ['#000000', '#EF4444', '#3B82F6'],
            ],
        ];

        foreach ($products as $data) {
            $category = Category::where('slug', $data['category'])->first();

            if (! $category) {
                continue;
            }

            Product::create([
                'category_id' => $category->id,
                'name' => $data['name'],
                'slug' => Str::slug($data['name']),
                'description' => 'Premium quality product crafted for everyday comfort and style. Designed with attention to detail, durable materials, and a modern aesthetic that fits seamlessly into your wardrobe or lifestyle.',
                'price' => $data['price'],
                'original_price' => $data['original_price'],
                'image' => $data['image'],
                'rating' => $data['rating'],
                'review_count' => $data['review_count'],
                'is_new' => $data['is_new'],
                'discount_percent' => $data['discount_percent'],
                'stock' => $data['stock'],
                'brand' => 'E-SHOP',
                'sizes' => $data['sizes'],
                'colors' => $data['colors'],
                'is_featured' => $data['is_featured'] ?? false,
                'is_deal' => $data['is_deal'] ?? false,
            ]);
        }
    }
}
