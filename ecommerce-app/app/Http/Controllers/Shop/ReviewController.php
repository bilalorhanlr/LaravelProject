<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request, Product $product): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:255'],
            'comment' => ['required', 'string', 'max:5000'],
            'rate' => ['required', 'integer', 'min:1', 'max:5'],
        ]);

        Comment::create([
            'product_id' => $product->id,
            'user_id' => auth()->id(),
            'name' => $validated['name'],
            'email' => $validated['email'],
            'comment' => $validated['comment'],
            'rate' => $validated['rate'],
            'ip' => $request->ip(),
            'status' => 'active',
        ]);

        $product->syncReviewStats();

        return redirect()
            ->route('products.show', $product)
            ->withFragment('reviews')
            ->with('review_success', 'Thank you! Your review has been published.');
    }
}
