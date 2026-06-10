@extends('layouts.auth')

@section('title', 'Register')

@section('content')
<div>
    <h1 class="text-3xl font-extrabold tracking-tight text-shop-dark">Create account</h1>
    <p class="mt-2 text-shop-muted">Join E-SHOP and start your shopping journey today.</p>

    @if ($errors->any())
        <div class="mt-6 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-600">
            <ul class="list-inside list-disc space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}" class="mt-8 space-y-5">
        @csrf

        <div>
            <label for="name" class="mb-1.5 block text-sm font-semibold text-shop-dark">Full Name</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                class="w-full rounded-xl border-slate-200 shadow-sm focus:border-shop-orange focus:ring-shop-orange">
        </div>

        <div>
            <label for="email" class="mb-1.5 block text-sm font-semibold text-shop-dark">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                class="w-full rounded-xl border-slate-200 shadow-sm focus:border-shop-orange focus:ring-shop-orange">
        </div>

        <div>
            <label for="password" class="mb-1.5 block text-sm font-semibold text-shop-dark">Password</label>
            <input id="password" type="password" name="password" required autocomplete="new-password"
                class="w-full rounded-xl border-slate-200 shadow-sm focus:border-shop-orange focus:ring-shop-orange">
        </div>

        <div>
            <label for="password_confirmation" class="mb-1.5 block text-sm font-semibold text-shop-dark">Confirm Password</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                class="w-full rounded-xl border-slate-200 shadow-sm focus:border-shop-orange focus:ring-shop-orange">
        </div>

        @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
            <label class="flex items-start gap-3 text-sm text-shop-muted">
                <input type="checkbox" name="terms" id="terms" required class="mt-1 rounded border-slate-300 text-shop-orange focus:ring-shop-orange">
                <span>
                    I agree to the
                    <a href="{{ route('terms.show') }}" target="_blank" class="font-semibold text-shop-orange hover:underline">Terms</a>
                    and
                    <a href="{{ route('policy.show') }}" target="_blank" class="font-semibold text-shop-orange hover:underline">Privacy Policy</a>
                </span>
            </label>
        @endif

        <button type="submit" class="shop-btn w-full py-3.5">Create Account</button>
    </form>

    <p class="mt-8 text-center text-sm text-shop-muted">
        Already have an account?
        <a href="{{ route('login') }}" class="font-semibold text-shop-orange hover:underline">Sign in</a>
    </p>

    <a href="{{ route('home') }}" class="mt-6 flex items-center justify-center gap-2 text-sm text-shop-muted hover:text-shop-orange">
        ← Back to store
    </a>
</div>
@endsection
