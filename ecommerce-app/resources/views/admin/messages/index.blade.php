@extends('admin.layouts.app')

@section('title', 'Messages')

@section('content')
@include('admin.partials.page-header', ['title' => 'Messages', 'breadcrumb' => 'List'])

<div class="overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm">
    <div class="border-b border-slate-200 px-4 py-3">
        <h3 class="text-base font-semibold text-slate-800">Message List</h3>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="border-b border-slate-200 bg-slate-50 text-left text-xs uppercase text-slate-500">
                <tr>
                    <th class="px-4 py-3">#</th>
                    <th class="px-4 py-3">Name</th>
                    <th class="px-4 py-3">Email</th>
                    <th class="px-4 py-3">Subject</th>
                    <th class="px-4 py-3">Message</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3">Date</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($messages as $message)
                    <tr class="hover:bg-slate-50">
                        <td class="px-4 py-3 text-slate-500">{{ $message->id }}</td>
                        <td class="px-4 py-3 font-medium text-slate-800">{{ $message->name }}</td>
                        <td class="px-4 py-3 text-slate-600">{{ $message->email }}</td>
                        <td class="px-4 py-3 text-slate-600">{{ $message->subject }}</td>
                        <td class="max-w-xs truncate px-4 py-3 text-slate-600">{{ $message->message }}</td>
                        <td class="px-4 py-3">
                            <span class="rounded-full px-2 py-0.5 text-xs font-semibold {{ $message->status === 'read' ? 'bg-green-100 text-green-700' : 'bg-amber-100 text-amber-700' }}">
                                {{ ucfirst($message->status ?? 'unread') }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-slate-500">{{ $message->created_at->format('M d, Y') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-4 py-10 text-center text-slate-500">No messages yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="border-t border-slate-200 px-4 py-3">{{ $messages->links() }}</div>
</div>
@endsection
