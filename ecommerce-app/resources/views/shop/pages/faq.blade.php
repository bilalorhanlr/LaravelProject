@extends('shop.pages._layout')

@section('title', 'FAQ')

@section('page-title', 'Frequently Asked Questions')

@section('page-content')
    @foreach ([
        ['q' => 'How long does shipping take?', 'a' => 'Standard shipping takes 3-5 business days. Express shipping is available at checkout.'],
        ['q' => 'What is your return policy?', 'a' => 'We offer 30-day hassle-free returns on all unused items in original packaging.'],
        ['q' => 'Do you ship internationally?', 'a' => 'Yes, we ship to over 50 countries worldwide.'],
        ['q' => 'How can I track my order?', 'a' => 'Once shipped, you will receive a tracking number via email.'],
    ] as $item)
        <details class="mb-4 rounded-2xl border border-slate-100 bg-white p-5 shadow-sm">
            <summary class="cursor-pointer font-semibold text-shop-dark">{{ $item['q'] }}</summary>
            <p class="mt-3 text-sm text-shop-muted">{{ $item['a'] }}</p>
        </details>
    @endforeach
@endsection
