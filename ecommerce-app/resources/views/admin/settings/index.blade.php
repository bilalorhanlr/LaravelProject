@extends('admin.layouts.app')

@section('title', 'Settings')

@section('content')
@include('admin.partials.page-header', [
    'title' => 'Settings',
    'breadcrumb' => ucfirst($tab),
    'description' => 'Configure store information, pages and integrations.',
])

@php
    $tabLabels = [
        'general' => 'General',
        'smtp' => 'Smtp Email',
        'social' => 'Social Media',
        'about' => 'About Us',
        'contact' => 'Contact Page',
        'references' => 'References',
    ];
@endphp

<div class="admin-card">
    <div class="border-b border-slate-100 px-5 py-4">
        <div class="flex flex-wrap gap-2">
            @foreach ($tabs as $tabKey)
                <a
                    href="{{ route('admin.settings.index', ['tab' => $tabKey]) }}"
                    class="rounded-full px-4 py-2 text-sm font-semibold transition {{ $tab === $tabKey ? 'bg-admin-primary text-white shadow-sm shadow-admin-primary/25' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}"
                >
                    {{ $tabLabels[$tabKey] }}
                </a>
            @endforeach
        </div>
    </div>

    <form action="{{ route('admin.settings.update') }}" method="POST" class="admin-card-body">
        @csrf
        @method('PUT')
        <input type="hidden" name="tab" value="{{ $tab }}">

        @if ($tab === 'general')
            <div class="mx-auto max-w-2xl space-y-4">
                <div>
                    <label class="mb-1 block text-sm font-bold text-slate-700">Title</label>
                    <input type="text" name="title" value="{{ old('title', $setting->title) }}" required class="w-full rounded border-slate-300 text-sm">
                </div>
                <div>
                    <label class="mb-1 block text-sm font-bold text-slate-700">Keywords</label>
                    <input type="text" name="keywords" value="{{ old('keywords', $setting->keywords) }}" class="w-full rounded border-slate-300 text-sm">
                </div>
                <div>
                    <label class="mb-1 block text-sm font-bold text-slate-700">Description</label>
                    <textarea name="description" rows="3" class="w-full rounded border-slate-300 text-sm">{{ old('description', $setting->description) }}</textarea>
                </div>
                <div>
                    <label class="mb-1 block text-sm font-bold text-slate-700">company</label>
                    <input type="text" name="company" value="{{ old('company', $setting->company) }}" class="w-full rounded border-slate-300 text-sm">
                </div>
                <div>
                    <label class="mb-1 block text-sm font-bold text-slate-700">Address</label>
                    <textarea name="address" rows="2" class="w-full rounded border-slate-300 text-sm">{{ old('address', $setting->address) }}</textarea>
                </div>
                <div>
                    <label class="mb-1 block text-sm font-bold text-slate-700">Phone</label>
                    <input type="text" name="phone" value="{{ old('phone', $setting->phone) }}" class="w-full rounded border-slate-300 text-sm">
                </div>
                <div>
                    <label class="mb-1 block text-sm font-bold text-slate-700">Fax</label>
                    <input type="text" name="fax" value="{{ old('fax', $setting->fax) }}" class="w-full rounded border-slate-300 text-sm">
                </div>
                <div>
                    <label class="mb-1 block text-sm font-bold text-slate-700">email</label>
                    <input type="email" name="email" value="{{ old('email', $setting->email) }}" class="w-full rounded border-slate-300 text-sm">
                </div>
                <div>
                    <label class="mb-1 block text-sm font-bold text-slate-700">Status</label>
                    <select name="status" class="w-full rounded border-slate-300 text-sm">
                        <option value="active" @selected(old('status', $setting->status) === 'active')>Active</option>
                        <option value="inactive" @selected(old('status', $setting->status) === 'inactive')>Inactive</option>
                    </select>
                </div>
            </div>
        @elseif ($tab === 'smtp')
            <div class="mx-auto max-w-2xl space-y-4">
                <div>
                    <label class="mb-1 block text-sm font-bold text-slate-700">SMTP Server</label>
                    <input type="text" name="smtpserver" value="{{ old('smtpserver', $setting->smtpserver) }}" class="w-full rounded border-slate-300 text-sm" placeholder="smtp.gmail.com">
                </div>
                <div>
                    <label class="mb-1 block text-sm font-bold text-slate-700">SMTP Email</label>
                    <input type="email" name="smtpemail" value="{{ old('smtpemail', $setting->smtpemail) }}" class="w-full rounded border-slate-300 text-sm">
                </div>
                <div>
                    <label class="mb-1 block text-sm font-bold text-slate-700">SMTP Password</label>
                    <input type="password" name="smtppassword" value="{{ old('smtppassword', $setting->smtppassword) }}" class="w-full rounded border-slate-300 text-sm">
                </div>
                <div>
                    <label class="mb-1 block text-sm font-bold text-slate-700">SMTP Port</label>
                    <input type="text" name="smtpport" value="{{ old('smtpport', $setting->smtpport) }}" class="w-full rounded border-slate-300 text-sm" placeholder="587">
                </div>
            </div>
        @elseif ($tab === 'social')
            <div class="mx-auto max-w-2xl space-y-4">
                <div>
                    <label class="mb-1 block text-sm font-bold text-slate-700">Facebook</label>
                    <input type="url" name="facebook" value="{{ old('facebook', $setting->facebook) }}" class="w-full rounded border-slate-300 text-sm">
                </div>
                <div>
                    <label class="mb-1 block text-sm font-bold text-slate-700">Instagram</label>
                    <input type="url" name="instagram" value="{{ old('instagram', $setting->instagram) }}" class="w-full rounded border-slate-300 text-sm">
                </div>
                <div>
                    <label class="mb-1 block text-sm font-bold text-slate-700">Twitter</label>
                    <input type="url" name="twitter" value="{{ old('twitter', $setting->twitter) }}" class="w-full rounded border-slate-300 text-sm">
                </div>
            </div>
        @elseif ($tab === 'about')
            <div class="mx-auto max-w-3xl">
                <label class="mb-1 block text-sm font-bold text-slate-700">aboutus</label>
                <textarea name="aboutus" rows="12" class="w-full rounded border-slate-300 text-sm">{{ old('aboutus', $setting->aboutus) }}</textarea>
                <p class="mt-1 text-xs text-slate-500">Displayed on the public About Us page (/about).</p>
            </div>
        @elseif ($tab === 'contact')
            <div class="mx-auto max-w-3xl">
                <label class="mb-1 block text-sm font-bold text-slate-700">contact</label>
                <textarea name="contact" rows="12" class="w-full rounded border-slate-300 text-sm">{{ old('contact', $setting->contact) }}</textarea>
                <p class="mt-1 text-xs text-slate-500">Contact information shown on the Contact Us page (/contact).</p>
            </div>
        @elseif ($tab === 'references')
            <div class="mx-auto max-w-3xl">
                <label class="mb-1 block text-sm font-bold text-slate-700">references</label>
                <textarea name="references" rows="12" class="w-full rounded border-slate-300 text-sm">{{ old('references', $setting->references) }}</textarea>
            </div>
        @endif

        <div class="mt-6">
            <button type="submit" class="admin-btn">Update Settings</button>
        </div>
    </form>
</div>
@endsection
