<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\Setting;
use Illuminate\View\View;

class PageController extends Controller
{
    public function store(): View
    {
        return view('shop.pages.store');
    }

    public function newsletter(): View
    {
        return view('shop.pages.newsletter');
    }

    public function faq(): View
    {
        return view('shop.pages.faq', [
            'faqs' => Faq::where('status', 'active')->latest()->get(),
        ]);
    }

    public function about(): View
    {
        return view('shop.pages.about', [
            'setting' => Setting::first(),
        ]);
    }

    public function shipping(): View
    {
        return view('shop.pages.shipping');
    }

    public function wishlist(): View
    {
        return view('shop.pages.wishlist');
    }

    public function compare(): View
    {
        return view('shop.pages.compare');
    }
}
