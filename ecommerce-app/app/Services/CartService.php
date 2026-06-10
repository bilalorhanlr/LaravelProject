<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Collection;

class CartService
{
    private const SESSION_KEY = 'cart';

    public function items(): Collection
    {
        return collect(session(self::SESSION_KEY, []));
    }

    public function add(Product $product, int $quantity = 1, ?string $size = null, ?string $color = null): void
    {
        $quantity = max(1, $quantity);
        $size = $size ?: ($product->sizes[0] ?? 'Standard');
        $color = $color ?: ($product->colors[0] ?? 'default');

        $cart = session(self::SESSION_KEY, []);
        $key = $this->makeKey($product->id, $size, $color);

        if (isset($cart[$key])) {
            $cart[$key]['quantity'] += $quantity;
        } else {
            $cart[$key] = [
                'key' => $key,
                'product_id' => $product->id,
                'slug' => $product->slug,
                'name' => $product->name,
                'price' => (float) $product->price,
                'image' => $product->image,
                'quantity' => $quantity,
                'size' => $size,
                'color' => $color,
            ];
        }

        session([self::SESSION_KEY => $cart]);
    }

    public function update(string $key, int $quantity): void
    {
        $cart = session(self::SESSION_KEY, []);

        if (! isset($cart[$key])) {
            return;
        }

        if ($quantity <= 0) {
            unset($cart[$key]);
        } else {
            $cart[$key]['quantity'] = $quantity;
        }

        session([self::SESSION_KEY => $cart]);
    }

    public function remove(string $key): void
    {
        $cart = session(self::SESSION_KEY, []);
        unset($cart[$key]);
        session([self::SESSION_KEY => $cart]);
    }

    public function clear(): void
    {
        session()->forget(self::SESSION_KEY);
    }

    public function count(): int
    {
        return $this->items()->sum('quantity');
    }

    public function subtotal(): float
    {
        return $this->items()->sum(fn (array $item) => $item['price'] * $item['quantity']);
    }

    public function formattedSubtotal(): string
    {
        return '$'.number_format($this->subtotal(), 2);
    }

    public function isEmpty(): bool
    {
        return $this->items()->isEmpty();
    }

    private function makeKey(int $productId, string $size, string $color): string
    {
        return $productId.'_'.md5($size.$color);
    }
}
