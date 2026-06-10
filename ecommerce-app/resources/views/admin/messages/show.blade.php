@extends('admin.layouts.app')

@section('title', 'Message #'.$message->id)

@section('content')
@include('admin.partials.page-header', ['title' => 'Message Detail', 'breadcrumb' => 'Messages / Show'])

<div class="mb-4 flex gap-2">
    <a href="{{ route('admin.messages.index') }}" class="rounded border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-600 hover:bg-slate-50">← Back to Messages</a>
    <form action="{{ route('admin.messages.destroy', $message->id) }}" method="POST" onsubmit="return confirm('Delete this message?')">
        @csrf
        @method('DELETE')
        <button type="submit" class="rounded bg-admin-danger px-4 py-2 text-sm font-semibold text-white hover:bg-red-600">Delete</button>
    </form>
</div>

<div class="overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm">
    <div class="border-b border-slate-200 px-6 py-4">
        <div class="flex items-center justify-between">
            <h3 class="text-lg font-semibold text-slate-800">{{ $message->subject ?? 'Contact Form' }}</h3>
            <span class="rounded-full px-2 py-0.5 text-xs font-semibold {{ $message->status === 'read' ? 'bg-green-100 text-green-700' : 'bg-amber-100 text-amber-700' }}">
                {{ ucfirst($message->status) }}
            </span>
        </div>
        <p class="mt-1 text-sm text-slate-500">{{ $message->created_at->format('M d, Y H:i') }}</p>
    </div>
    <dl class="grid gap-4 p-6 sm:grid-cols-2">
        <div>
            <dt class="text-xs font-semibold uppercase text-slate-500">Name</dt>
            <dd class="mt-1 font-medium text-slate-800">{{ $message->name }}</dd>
        </div>
        <div>
            <dt class="text-xs font-semibold uppercase text-slate-500">Email</dt>
            <dd class="mt-1"><a href="mailto:{{ $message->email }}" class="text-admin-primary hover:underline">{{ $message->email }}</a></dd>
        </div>
        <div>
            <dt class="text-xs font-semibold uppercase text-slate-500">Phone</dt>
            <dd class="mt-1 text-slate-800">{{ $message->phone ?? '—' }}</dd>
        </div>
        <div>
            <dt class="text-xs font-semibold uppercase text-slate-500">IP Address</dt>
            <dd class="mt-1 text-slate-800">{{ $message->ip ?? '—' }}</dd>
        </div>
        <div class="sm:col-span-2">
            <dt class="text-xs font-semibold uppercase text-slate-500">Message</dt>
            <dd class="mt-2 whitespace-pre-wrap rounded-lg bg-slate-50 p-4 text-slate-700">{{ $message->message }}</dd>
        </div>
    </dl>
</div>
@endsection
