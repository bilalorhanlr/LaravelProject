@extends('layouts.shop')

@section('title', 'User Profile')

@section('content')
<div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
    <nav class="mb-6 flex items-center gap-2 text-sm text-shop-muted">
        <a href="{{ route('home') }}" class="hover:text-shop-orange">Home</a>
        <span>/</span>
        <span class="font-medium text-shop-orange">User Panel</span>
    </nav>

    <h1 class="shop-section-title">User Panel</h1>

    @if (session('success'))
        <div class="mt-4 rounded-2xl border border-green-200 bg-green-50 px-5 py-3 text-sm text-green-700">{{ session('success') }}</div>
    @endif

    <div class="mt-8 grid gap-8 lg:grid-cols-4">
        <div class="lg:col-span-1">
            @include('partials.shop.user-sidebar')
        </div>

        <div class="space-y-8 lg:col-span-3">
            <div class="rounded-2xl border border-slate-100 bg-white p-6 shadow-card">
                <h2 class="text-lg font-bold text-shop-dark">User Profile</h2>
                <p class="mt-1 text-sm text-shop-muted">Update your account's profile information and email address.</p>

                <form action="{{ route('user.profile.update') }}" method="POST" class="mt-6 space-y-4">
                    @csrf
                    @method('PUT')
                    <div>
                        <label class="mb-1 block text-sm font-semibold text-shop-dark">Name</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                            class="w-full rounded-xl border-slate-200 text-sm focus:border-shop-orange focus:ring-shop-orange">
                        @error('name')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="mb-1 block text-sm font-semibold text-shop-dark">Surname</label>
                        <input type="text" name="surname" value="{{ old('surname', $user->surname) }}"
                            class="w-full rounded-xl border-slate-200 text-sm focus:border-shop-orange focus:ring-shop-orange">
                    </div>
                    <div>
                        <label class="mb-1 block text-sm font-semibold text-shop-dark">Email</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                            class="w-full rounded-xl border-slate-200 text-sm focus:border-shop-orange focus:ring-shop-orange">
                        @error('email')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                    </div>
                    <div class="text-right">
                        <button type="submit" class="shop-btn">Save</button>
                    </div>
                </form>
            </div>

            <div class="rounded-2xl border border-slate-100 bg-white p-6 shadow-card">
                <h2 class="text-lg font-bold text-shop-dark">Update Password</h2>
                <p class="mt-1 text-sm text-shop-muted">Ensure your account is using a long, random password to stay secure.</p>

                <form action="{{ route('user.password.update') }}" method="POST" class="mt-6 space-y-4" autocomplete="off">
                    @csrf
                    @method('PUT')
                    <div>
                        <label class="mb-1 block text-sm font-semibold text-shop-dark">Current Password</label>
                        <input type="password" name="current_password" required
                            class="w-full rounded-xl border-slate-200 text-sm focus:border-shop-orange focus:ring-shop-orange">
                        @error('current_password')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="mb-1 block text-sm font-semibold text-shop-dark">New Password</label>
                        <input type="password" name="password" required
                            class="w-full rounded-xl border-slate-200 text-sm focus:border-shop-orange focus:ring-shop-orange">
                        @error('password')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="mb-1 block text-sm font-semibold text-shop-dark">Confirm Password</label>
                        <input type="password" name="password_confirmation" required
                            class="w-full rounded-xl border-slate-200 text-sm focus:border-shop-orange focus:ring-shop-orange">
                    </div>
                    <div class="text-right">
                        <button type="submit" class="shop-btn">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
