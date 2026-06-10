<?php

use App\Http\Controllers\Shop\CartController;
use App\Http\Controllers\Shop\CategoryController;
use App\Http\Controllers\Shop\ContactController;
use App\Http\Controllers\Shop\HomeController;
use App\Http\Controllers\Shop\PageController;
use App\Http\Controllers\Shop\ProductController;
use App\Http\Controllers\Shop\ReviewController;
use App\Http\Controllers\Shop\UserPanelController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/shop', [ProductController::class, 'index'])->name('shop');
Route::get('/sales', [ProductController::class, 'sales'])->name('sales');
Route::get('/products/{product:slug}', [ProductController::class, 'show'])->name('products.show');
Route::post('/products/{product:slug}/reviews', [ReviewController::class, 'store'])->name('products.reviews.store');
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/category/{category:slug}', [CategoryController::class, 'show'])->name('categories.show');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::get('/cart/add/{product:slug}', [CartController::class, 'quickAdd'])->name('cart.quick-add');
Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
Route::patch('/cart/{key}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/{key}', [CartController::class, 'destroy'])->name('cart.destroy');
Route::delete('/cart', [CartController::class, 'clear'])->name('cart.clear');

Route::get('/store', [PageController::class, 'store'])->name('pages.store');
Route::get('/newsletter', [PageController::class, 'newsletter'])->name('pages.newsletter');
Route::get('/faq', [PageController::class, 'faq'])->name('pages.faq');
Route::get('/about', [PageController::class, 'about'])->name('pages.about');
Route::get('/contact', [ContactController::class, 'index'])->name('pages.contact');
Route::post('/contact', [ContactController::class, 'store'])->name('pages.contact.store');
Route::get('/shipping', [PageController::class, 'shipping'])->name('pages.shipping');
Route::get('/wishlist', [PageController::class, 'wishlist'])->name('pages.wishlist');
Route::get('/compare', [PageController::class, 'compare'])->name('pages.compare');
Route::get('/checkout', [PageController::class, 'checkout'])->name('pages.checkout');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::redirect('/dashboard', '/')->name('dashboard');

    Route::prefix('user')->name('user.')->group(function () {
        Route::redirect('/panel', '/user/profile')->name('panel');
        Route::get('/profile', [UserPanelController::class, 'profile'])->name('profile');
        Route::put('/profile', [UserPanelController::class, 'updateProfile'])->name('profile.update');
        Route::put('/change-password', [UserPanelController::class, 'updatePassword'])->name('password.update');
        Route::get('/reviews', [UserPanelController::class, 'reviews'])->name('reviews');
        Route::delete('/reviews/{id}', [UserPanelController::class, 'destroyReview'])->name('reviews.destroy');
        Route::get('/orders', [UserPanelController::class, 'orders'])->name('orders');
    });
});
