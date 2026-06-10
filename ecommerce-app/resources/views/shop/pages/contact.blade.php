@extends('layouts.shop')

@section('title', 'Contact Us')

@section('content')
<div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
    <nav class="mb-8 flex items-center gap-2 text-sm text-shop-muted">
        <a href="{{ route('home') }}" class="hover:text-shop-orange">Home</a>
        <span>/</span>
        <span class="font-medium text-shop-orange">Contact</span>
    </nav>

    @if (session('contact_success'))
        <div class="mb-6 rounded-2xl border border-green-200 bg-green-50 px-5 py-4 text-sm text-green-700">
            {{ session('contact_success') }}
        </div>
    @endif

    <div class="grid gap-10 lg:grid-cols-2">
        {{-- Contact Form --}}
        <div>
            <h2 class="text-lg font-bold uppercase tracking-wide text-shop-dark">
                Contact Form
                <span class="mt-2 block h-1 w-12 bg-shop-orange"></span>
            </h2>

            <form action="{{ route('pages.contact.store') }}" method="POST" class="mt-8 space-y-4">
                @csrf
                <div>
                    <input type="text" name="first_name" value="{{ old('first_name') }}" placeholder="First Name" required
                        class="w-full rounded border-slate-200 px-4 py-3 text-sm shadow-sm focus:border-shop-orange focus:ring-shop-orange">
                    @error('first_name')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                </div>
                <div>
                    <input type="text" name="last_name" value="{{ old('last_name') }}" placeholder="Last Name" required
                        class="w-full rounded border-slate-200 px-4 py-3 text-sm shadow-sm focus:border-shop-orange focus:ring-shop-orange">
                    @error('last_name')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                </div>
                <div>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="Email" required
                        class="w-full rounded border-slate-200 px-4 py-3 text-sm shadow-sm focus:border-shop-orange focus:ring-shop-orange">
                    @error('email')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                </div>
                <div>
                    <input type="text" name="phone" value="{{ old('phone') }}" placeholder="Telephone"
                        class="w-full rounded border-slate-200 px-4 py-3 text-sm shadow-sm focus:border-shop-orange focus:ring-shop-orange">
                    @error('phone')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                </div>
                <div>
                    <textarea name="message" rows="5" placeholder="Your Message" required
                        class="w-full rounded border-slate-200 px-4 py-3 text-sm shadow-sm focus:border-shop-orange focus:ring-shop-orange">{{ old('message') }}</textarea>
                    @error('message')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                </div>
                <button type="submit" class="shop-btn">Send Message</button>
            </form>
        </div>

        {{-- Contact Information --}}
        <div>
            <h2 class="text-lg font-bold uppercase tracking-wide text-shop-dark">
                Contact Information
                <span class="mt-2 block h-1 w-12 bg-shop-orange"></span>
            </h2>

            <div class="mt-8 space-y-6 text-shop-muted">
                @if ($setting?->contact)
                    <div class="prose prose-sm max-w-none">{!! nl2br(e($setting->contact)) !!}</div>
                @else
                    <div>
                        <h3 class="text-xl font-bold text-shop-dark">Headquarters</h3>
                        <p class="mt-2 leading-relaxed">
                            Our global headquarters are in the UK. We also have a significant presence in the USA and regional headquarters in Singapore.
                        </p>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-shop-dark">Customer Support</h3>
                        <p class="mt-2 leading-relaxed">
                            Reach us by email or phone. We respond to all inquiries within 24 business hours.
                        </p>
                    </div>
                @endif

                <dl class="space-y-3 rounded-2xl border border-slate-100 bg-shop-surface/50 p-6 text-sm">
                    @if ($setting?->company)
                        <div><dt class="font-bold text-shop-dark">Company</dt><dd>{{ $setting->company }}</dd></div>
                    @endif
                    @if ($setting?->address)
                        <div><dt class="font-bold text-shop-dark">Address</dt><dd>{{ $setting->address }}</dd></div>
                    @endif
                    @if ($setting?->phone)
                        <div><dt class="font-bold text-shop-dark">Phone</dt><dd>{{ $setting->phone }}</dd></div>
                    @endif
                    @if ($setting?->email)
                        <div><dt class="font-bold text-shop-dark">Email</dt><dd><a href="mailto:{{ $setting->email }}" class="text-shop-orange hover:underline">{{ $setting->email }}</a></dd></div>
                    @endif
                </dl>
            </div>
        </div>
    </div>
</div>
@endsection
