<li>
    <div class="flex items-center gap-3 rounded-lg px-3 py-2 hover:bg-slate-50" style="padding-left: {{ ($depth * 1.5) + 0.75 }}rem">
        @if ($category->image)
            <img src="{{ $category->image }}" alt="" class="h-8 w-8 rounded object-cover border">
        @else
            <div class="flex h-8 w-8 items-center justify-center rounded bg-slate-100 text-xs text-slate-400">
                <ion-icon name="folder-outline"></ion-icon>
            </div>
        @endif
        <div class="flex-1">
            <span class="font-medium text-slate-800">{{ $category->title }}</span>
            <span class="ml-2 text-xs text-slate-400">({{ $category->products_count }} products)</span>
            <span class="ml-2 rounded px-1.5 py-0.5 text-[10px] font-semibold {{ $category->status === 'active' ? 'bg-green-100 text-green-700' : 'bg-slate-100 text-slate-500' }}">
                {{ $category->status }}
            </span>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('admin.categories.show', $category->id) }}" class="text-xs text-green-600 hover:underline">Show</a>
            <a href="{{ route('admin.categories.edit', $category->id) }}" class="text-xs text-admin-primary hover:underline">Edit</a>
            <a href="{{ route('admin.categories.create') }}?parent_id={{ $category->id }}" class="text-xs text-slate-500 hover:underline">+ Sub</a>
        </div>
    </div>
    @if ($category->children->isNotEmpty())
        <ul class="border-l border-slate-200 ml-6">
            @foreach ($category->children as $child)
                @include('admin.categories._tree-item', ['category' => $child, 'depth' => $depth + 1])
            @endforeach
        </ul>
    @endif
</li>
