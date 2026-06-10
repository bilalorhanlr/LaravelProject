@extends('layouts.auth')

@section('title', 'Login')

@section('content')
<div>
    <h1 class="text-3xl font-extrabold tracking-tight text-shop-dark">Welcome back</h1>
    <p class="mt-2 text-shop-muted">Sign in to your account to continue shopping.</p>

    @if ($errors->any())
        <div class="mt-6 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-600">
            <ul class="list-inside list-disc space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @session('status')
        <div class="mt-6 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
            {{ $value }}
        </div>
    @endsession

    <form method="POST" action="{{ route('login') }}" class="mt-8 space-y-5">
        @csrf

        <div>
            <label for="email" class="mb-1.5 block text-sm font-semibold text-shop-dark">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                class="w-full rounded-xl border-slate-200 shadow-sm focus:border-shop-orange focus:ring-shop-orange">
        </div>

        <div>
            <label for="password" class="mb-1.5 block text-sm font-semibold text-shop-dark">Password</label>
            <input id="password" type="password" name="password" required autocomplete="current-password"
                class="w-full rounded-xl border-slate-200 shadow-sm focus:border-shop-orange focus:ring-shop-orange">
        </div>

        <div class="flex items-center justify-between">
            <label class="flex items-center gap-2 text-sm text-shop-muted">
                <input type="checkbox" name="remember" class="rounded border-slate-300 text-shop-orange focus:ring-shop-orange">
                Remember me
            </label>
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-sm font-semibold text-shop-orange hover:underline">Forgot password?</a>
            @endif
        </div>

        <button type="submit" class="shop-btn w-full py-3.5">Sign In</button>
    </form>

    <p class="mt-8 text-center text-sm text-shop-muted">
        Don't have an account?
        <a href="{{ route('register') }}" class="font-semibold text-shop-orange hover:underline">Create one</a>
    </p>

    <a href="{{ route('home') }}" class="mt-6 flex items-center justify-center gap-2 text-sm text-shop-muted hover:text-shop-orange">
        ← Back to store
    </a>
</div>
@endsection
