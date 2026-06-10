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
                'name' => $name,
                'slug' => Str::slug($name),
                'sort_order' => $index + 1,
            ]);

            foreach ($children as $childIndex => $childName) {
                Category::create([
                    'parent_id' => $parent->id,
                    'name' => $childName,
                    'slug' => Str::slug($childName.'-'.$parent->slug),
                    'sort_order' => $childIndex + 1,
                ]);
            }
        }
    }
}
