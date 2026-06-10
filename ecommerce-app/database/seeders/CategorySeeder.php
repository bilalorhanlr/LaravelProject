<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ["Women's Clothing", ['Dresses', 'Tops & Blouses', 'Skirts']],
            ["Men's Clothing", ['Shirts', 'Pants', 'Jackets']],
            ['Phones & Accessories', ['Smartphones', 'Cases', 'Chargers']],
            ['Computer & Office', ['Laptops', 'Monitors', 'Accessories']],
            ['Consumer Electronics', ['Audio', 'Cameras', 'Smart Home']],
            ['Jewelry & Watches', ['Necklaces', 'Rings', 'Watches']],
            ['Bags & Shoes', ['Handbags', 'Sneakers', 'Boots']],
        ];

        foreach ($categories as $index => [$name, $children]) {
            $parent = Category::create([
                'title' => $name,
                'slug' => Str::slug($name),
                'keywords' => Str::slug($name, ','),
                'description' => $name.' category',
                'status' => 'active',
                'sort_order' => $index + 1,
            ]);

            foreach ($children as $childIndex => $childName) {
                Category::create([
                    'parent_id' => $parent->id,
                    'title' => $childName,
                    'slug' => Str::slug($childName.'-'.$parent->slug),
                    'keywords' => Str::slug($childName, ','),
                    'status' => 'active',
                    'sort_order' => $childIndex + 1,
                ]);
            }
        }
    }
}
