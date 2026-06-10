<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class OrderService
{
    public const FREE_SHIPPING_THRESHOLD = 50;

    public const SHIPPING_COST = 5;

    public function __construct(
        private CartService $cart,
    ) {}

    public function shippingCost(float $subtotal): float
    {
        return $subtotal >= self::FREE_SHIPPING_THRESHOLD ? 0 : self::SHIPPING_COST;
    }

    public function grandTotal(float $subtotal): float
    {
        return $subtotal + $this->shippingCost($subtotal);
    }

    /**
     * @param  array{name: string, surname: string, email: string, address: string, phone: string, note?: string|null}  $shipping
     */
    public function placeOrder(array $shipping, ?int $userId = null): Order
    {
        if ($this->cart->isEmpty()) {
            throw ValidationException::withMessages([
                'cart' => 'Your cart is empty.',
            ]);
        }

        $items = $this->cart->items();
        $productIds = $items->pluck('product_id')->unique()->all();
        $products = Product::whereIn('id', $productIds)->get()->keyBy('id');

        $lineItems = [];
        $subtotal = 0;

        foreach ($items as $item) {
            $product = $products->get($item['product_id']);

            if (! $product) {
                throw ValidationException::withMessages([
                    'cart' => 'A product in your cart is no longer available.',
                ]);
            }

            if ($product->stock < $item['quantity']) {
                throw ValidationException::withMessages([
                    'cart' => "Not enough stock for {$product->name}. Available: {$product->stock}.",
                ]);
            }

            $price = (float) $product->price;
            $lineTotal = $price * $item['quantity'];
            $subtotal += $lineTotal;

            $lineItems[] = [
                'product' => $product,
                'product_id' => $product->id,
                'price' => $price,
                'amount' => $item['quantity'],
                'total' => $lineTotal,
                'size' => $item['size'] ?? null,
                'color' => $item['color'] ?? null,
            ];
        }

        $shippingCost = $this->shippingCost($subtotal);
        $grandTotal = $subtotal + $shippingCost;

        return DB::transaction(function () use ($shipping, $userId, $lineItems, $grandTotal, $shippingCost) {
            $order = Order::create([
                'user_id' => $userId,
                'name' => $shipping['name'],
                'surname' => $shipping['surname'],
                'email' => $shipping['email'],
                'address' => $shipping['address'],
                'phone' => $shipping['phone'],
                'total' => $grandTotal,
                'shipping_cost' => $shippingCost,
                'status' => Order::STATUS_PENDING,
                'note' => $shipping['note'] ?? null,
                'ip' => request()->ip(),
            ]);

            foreach ($lineItems as $line) {
                OrderProduct::create([
                    'user_id' => $userId,
                    'order_id' => $order->id,
                    'product_id' => $line['product_id'],
                    'price' => $line['price'],
                    'amount' => $line['amount'],
                    'total' => $line['total'],
                    'size' => $line['size'],
                    'color' => $line['color'],
                    'status' => 'active',
                    'ip' => request()->ip(),
                ]);

                $line['product']->decrement('stock', $line['amount']);
            }

            $this->cart->clear();

            return $order->load('orderProducts.product');
        });
    }

    public function approve(Order $order): void
    {
        if ($order->status !== Order::STATUS_PENDING) {
            throw ValidationException::withMessages([
                'status' => 'Only pending orders can be approved.',
            ]);
        }

        $order->update(['status' => Order::STATUS_APPROVED]);
    }

    public function reject(Order $order): void
    {
        if ($order->status !== Order::STATUS_PENDING) {
            throw ValidationException::withMessages([
                'status' => 'Only pending orders can be rejected.',
            ]);
        }

        DB::transaction(function () use ($order) {
            $order->load('orderProducts.product');

            foreach ($order->orderProducts as $line) {
                if ($line->product) {
                    $line->product->increment('stock', $line->amount);
                }
            }

            $order->update(['status' => Order::STATUS_REJECTED]);
        });
    }
}
