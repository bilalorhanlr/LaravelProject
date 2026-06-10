<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Database\Seeder;

class ProductImageSeeder extends Seeder
{
    /**
     * @var array<string, array{main: string, gallery: array<int, string>}>
     */
    private array $catalog = [
        'urban-runner-sneakers' => [
            'main' => '/images/products/urban-runner-sneakers-main.jpg',
            'gallery' => [
                '/images/products/urban-runner-sneakers-2.jpg',
                '/images/products/urban-runner-sneakers-3.jpg',
            ],
        ],
        'leather-crossbody-bag' => [
            'main' => '/images/products/leather-crossbody-bag-main.jpg',
            'gallery' => [
                '/images/products/leather-crossbody-bag-2.jpg',
            ],
        ],
        'minimalist-steel-watch' => [
            'main' => '/images/products/minimalist-steel-watch-main.jpg',
            'gallery' => [
                '/images/products/minimalist-steel-watch-2.jpg',
            ],
        ],
        'classic-leather-wallet' => [
            'main' => '/images/products/classic-leather-wallet-main.jpg',
            'gallery' => [],
        ],
        'silk-evening-dress' => [
            'main' => '/images/products/silk-evening-dress-main.jpg',
            'gallery' => [
                '/images/products/silk-evening-dress-2.jpg',
            ],
        ],
        'premium-cotton-shirt' => [
            'main' => '/images/products/premium-cotton-shirt-main.jpg',
            'gallery' => [
                '/images/products/premium-cotton-shirt-2.jpg',
            ],
        ],
        'wireless-noise-cancel-headphones' => [
            'main' => '/images/products/wireless-headphones-main.jpg',
            'gallery' => [
                '/images/products/wireless-headphones-2.jpg',
            ],
        ],
        'magsafe-phone-case' => [
            'main' => '/images/products/magsafe-phone-case-main.jpg',
            'gallery' => [
                '/images/products/magsafe-phone-case-2.jpg',
            ],
        ],
    ];

    public function run(): void
    {
        foreach ($this->catalog as $slug => $images) {
            $product = Product::where('slug', $slug)->first();

            if (! $product) {
                continue;
            }

            if (file_exists(public_path(ltrim($images['main'], '/')))) {
                $product->update(['image' => $images['main']]);
            }

            $product->images()->delete();

            foreach ($images['gallery'] as $index => $path) {
                if (! file_exists(public_path(ltrim($path, '/')))) {
                    continue;
                }

                ProductImage::create([
                    'product_id' => $product->id,
                    'title' => 'Gallery '.($index + 1),
                    'image' => $path,
                ]);
            }
        }

        // Fallback: assign placeholder to products still missing an image
        $placeholder = '/images/products/urban-runner-sneakers-main.jpg';

        Product::whereNull('image')
            ->orWhere('image', '')
            ->orWhere('image', 'like', 'https://%')
            ->each(function (Product $product) use ($placeholder) {
                $product->update(['image' => $placeholder]);

                if ($product->images()->count() === 0) {
                    ProductImage::create([
                        'product_id' => $product->id,
                        'title' => 'Gallery 1',
                        'image' => '/images/products/premium-cotton-shirt-2.jpg',
                    ]);
                }
            });
    }
}
