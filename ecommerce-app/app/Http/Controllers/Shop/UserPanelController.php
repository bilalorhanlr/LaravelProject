<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class UserPanelController extends Controller
{
    public function profile(): View
    {
        return view('shop.user.profile', [
            'user' => auth()->user(),
        ]);
    }

    public function updateProfile(Request $request): RedirectResponse
    {
        $user = $request->user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,'.$user->id],
        ]);

        $user->update($validated);

        return back()->with('success', 'Profile updated successfully.');
    }

    public function updatePassword(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('success', 'Password updated successfully.');
    }

    public function reviews(): View
    {
        $user = auth()->user();

        $reviews = Comment::with('product')
            ->where(function ($query) use ($user) {
                $query->where('user_id', $user->id)
                    ->orWhere('email', $user->email);
            })
            ->latest()
            ->paginate(10);

        return view('shop.user.reviews', compact('reviews'));
    }

    public function destroyReview(int $id): RedirectResponse
    {
        $user = auth()->user();

        $comment = Comment::with('product')
            ->where(function ($query) use ($user) {
                $query->where('user_id', $user->id)
                    ->orWhere('email', $user->email);
            })
            ->findOrFail($id);

        $product = $comment->product;
        $comment->delete();

        if ($product) {
            $product->syncReviewStats();
        }

        return back()->with('success', 'Review deleted successfully.');
    }

    public function orders(): View
    {
        $orders = Order::where('user_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('shop.user.orders', compact('orders'));
    }
}
