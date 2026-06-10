@extends('admin.layouts.app')

@section('title', 'Messages')

@section('content')
@include('admin.partials.page-header', [
    'title' => 'Messages',
    'breadcrumb' => 'Contact Inbox',
    'description' => 'Messages submitted through the contact form.',
])

@if ($unreadCount > 0)
    <div class="mb-5 flex items-center gap-3 rounded-xl border border-amber-200 bg-amber-50 px-4 py-3 text-sm text-amber-800">
        <ion-icon name="mail-unread-outline" class="text-xl text-amber-500"></ion-icon>
        {{ $unreadCount }} unread message(s) waiting for review.
    </div>
@endif

<div class="admin-card">
    <div class="admin-card-header">
        <h3 class="font-semibold text-slate-800">Message List</h3>
    </div>
    <div class="overflow-x-auto">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Sender</th>
                    <th>Message</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th class="text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($messages as $message)
                    <tr class="{{ $message->status === 'unread' ? 'bg-amber-50/40' : '' }}">
                        <td class="text-slate-500">#{{ $message->id }}</td>
                        <td>
                            <p class="font-semibold text-slate-800">{{ $message->name }}</p>
                            <p class="text-xs text-slate-500">{{ $message->email }}</p>
                            @if ($message->phone)
                                <p class="text-xs text-slate-400">{{ $message->phone }}</p>
                            @endif
                        </td>
                        <td class="max-w-xs truncate text-slate-600">{{ $message->message }}</td>
                        <td>
                            <span class="{{ $message->status === 'read' ? 'admin-badge-success' : 'admin-badge-warning' }}">
                                {{ ucfirst($message->status ?? 'unread') }}
                            </span>
                        </td>
                        <td class="text-slate-500">{{ $message->created_at->format('M d, Y') }}</td>
                        <td class="text-right">
                            <a href="{{ route('admin.messages.show', $message->id) }}" class="admin-btn-success !px-3">Open</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="py-12 text-center text-slate-500">No messages yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="admin-card-footer">{{ $messages->links() }}</div>
</div>
@endsection
