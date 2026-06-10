<?php

namespace App\Providers;

use App\Models\Category;
use App\Services\CartService;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(CartService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer(['layouts.shop', 'partials.shop.*'], function ($view) {
            $cart = app(CartService::class);

            $view->with([
                'navCategories' => Category::whereNull('parent_id')
                    ->with('children')
                    ->orderBy('sort_order')
                    ->get(),
                'cartCount' => $cart->count(),
                'cartSubtotal' => $cart->formattedSubtotal(),
            ]);
        });
    }
}
