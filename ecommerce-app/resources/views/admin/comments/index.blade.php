@extends('admin.layouts.app')

@section('title', 'Comments')

@section('content')
@include('admin.partials.page-header', ['title' => 'Comments', 'breadcrumb' => 'List'])

<div class="overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm">
    <div class="border-b border-slate-200 px-4 py-3">
        <h3 class="text-base font-semibold text-slate-800">Comment List</h3>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="border-b border-slate-200 bg-slate-50 text-left text-xs uppercase text-slate-500">
                <tr>
                    <th class="px-4 py-3">#</th>
                    <th class="px-4 py-3">Product</th>
                    <th class="px-4 py-3">User</th>
                    <th class="px-4 py-3">Comment</th>
                    <th class="px-4 py-3">Rate</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3">Date</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($comments as $comment)
                    <tr class="hover:bg-slate-50">
                        <td class="px-4 py-3 text-slate-500">{{ $comment->id }}</td>
                        <td class="px-4 py-3 font-medium text-slate-800">{{ $comment->product?->title ?? '—' }}</td>
                        <td class="px-4 py-3 text-slate-600">{{ $comment->reviewerName() }}</td>
                        <td class="max-w-xs truncate px-4 py-3 text-slate-600">{{ $comment->comment }}</td>
                        <td class="px-4 py-3">{{ $comment->rate }}/5</td>
                        <td class="px-4 py-3">
                            <span class="rounded-full px-2 py-0.5 text-xs font-semibold {{ $comment->status === 'active' ? 'bg-green-100 text-green-700' : 'bg-slate-100 text-slate-600' }}">
                                {{ ucfirst($comment->status ?? 'pending') }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-slate-500">{{ $comment->created_at->format('M d, Y') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-4 py-10 text-center text-slate-500">No comments yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="border-t border-slate-200 px-4 py-3">{{ $comments->links() }}</div>
</div>
@endsection
