@extends('admin.layouts.app')

@section('title', 'Settings')

@section('content')
@include('admin.partials.page-header', ['title' => 'Settings', 'breadcrumb' => 'General'])

<div class="overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm">
    <div class="border-b border-slate-200 px-4 py-3">
        <h3 class="text-base font-semibold text-slate-800">Site Settings</h3>
    </div>
    <div class="p-6">
        @if ($setting)
            <dl class="grid gap-4 sm:grid-cols-2">
                <div>
                    <dt class="text-xs font-semibold uppercase text-slate-500">Title</dt>
                    <dd class="mt-1 text-slate-800">{{ $setting->title ?? '—' }}</dd>
                </div>
                <div>
                    <dt class="text-xs font-semibold uppercase text-slate-500">Company</dt>
                    <dd class="mt-1 text-slate-800">{{ $setting->company ?? '—' }}</dd>
                </div>
                <div>
                    <dt class="text-xs font-semibold uppercase text-slate-500">Email</dt>
                    <dd class="mt-1 text-slate-800">{{ $setting->email ?? '—' }}</dd>
                </div>
                <div>
                    <dt class="text-xs font-semibold uppercase text-slate-500">Phone</dt>
                    <dd class="mt-1 text-slate-800">{{ $setting->phone ?? '—' }}</dd>
                </div>
                <div class="sm:col-span-2">
                    <dt class="text-xs font-semibold uppercase text-slate-500">Address</dt>
                    <dd class="mt-1 text-slate-800">{{ $setting->address ?? '—' }}</dd>
                </div>
                <div class="sm:col-span-2">
                    <dt class="text-xs font-semibold uppercase text-slate-500">Description</dt>
                    <dd class="mt-1 text-slate-600">{{ $setting->description ?? '—' }}</dd>
                </div>
                <div>
                    <dt class="text-xs font-semibold uppercase text-slate-500">Facebook</dt>
                    <dd class="mt-1 text-slate-800">{{ $setting->facebook ?? '—' }}</dd>
                </div>
                <div>
                    <dt class="text-xs font-semibold uppercase text-slate-500">Instagram</dt>
                    <dd class="mt-1 text-slate-800">{{ $setting->instagram ?? '—' }}</dd>
                </div>
                <div>
                    <dt class="text-xs font-semibold uppercase text-slate-500">Twitter</dt>
                    <dd class="mt-1 text-slate-800">{{ $setting->twitter ?? '—' }}</dd>
                </div>
                <div>
                    <dt class="text-xs font-semibold uppercase text-slate-500">Status</dt>
                    <dd class="mt-1">
                        <span class="rounded-full px-2 py-0.5 text-xs font-semibold {{ $setting->status === 'active' ? 'bg-green-100 text-green-700' : 'bg-slate-100 text-slate-600' }}">
                            {{ ucfirst($setting->status ?? 'inactive') }}
                        </span>
                    </dd>
                </div>
            </dl>
        @else
            <p class="text-center text-slate-500">No settings configured yet.</p>
        @endif
    </div>
</div>
@endsection
