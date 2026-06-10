<div class="grid gap-5 md:grid-cols-2">
    <div class="md:col-span-2">
        <label class="mb-1 block text-sm font-semibold text-slate-700">Title *</label>
        <input type="text" name="title" value="{{ old('title', $category->title ?? '') }}" required
            class="w-full rounded border-slate-300 text-sm focus:border-admin-primary focus:ring-admin-primary">
    </div>

    <div>
        <label class="mb-1 block text-sm font-semibold text-slate-700">Parent Category</label>
        <select name="parent_id" class="w-full rounded border-slate-300 text-sm focus:border-admin-primary focus:ring-admin-primary">
            <option value="">— Main Category —</option>
            @foreach ($parents as $parent)
                <option value="{{ $parent->id }}" @selected(old('parent_id', $category->parent_id ?? '') == $parent->id)>{{ $parent->title }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <label class="mb-1 block text-sm font-semibold text-slate-700">Slug</label>
        <input type="text" name="slug" value="{{ old('slug', $category->slug ?? '') }}" placeholder="auto-generated if empty"
            class="w-full rounded border-slate-300 text-sm focus:border-admin-primary focus:ring-admin-primary">
    </div>

    <div>
        <label class="mb-1 block text-sm font-semibold text-slate-700">Keywords</label>
        <input type="text" name="keywords" value="{{ old('keywords', $category->keywords ?? '') }}"
            class="w-full rounded border-slate-300 text-sm focus:border-admin-primary focus:ring-admin-primary">
    </div>

    <div>
        <label class="mb-1 block text-sm font-semibold text-slate-700">Status *</label>
        <select name="status" required class="w-full rounded border-slate-300 text-sm focus:border-admin-primary focus:ring-admin-primary">
            <option value="active" @selected(old('status', $category->status ?? 'active') === 'active')>Active</option>
            <option value="inactive" @selected(old('status', $category->status ?? '') === 'inactive')>Inactive</option>
        </select>
    </div>

    <div>
        <label class="mb-1 block text-sm font-semibold text-slate-700">Sort Order</label>
        <input type="number" name="sort_order" min="0" value="{{ old('sort_order', $category->sort_order ?? 0) }}"
            class="w-full rounded border-slate-300 text-sm focus:border-admin-primary focus:ring-admin-primary">
    </div>

    <div class="md:col-span-2">
        <label class="mb-1 block text-sm font-semibold text-slate-700">Description</label>
        <textarea name="description" rows="3" class="w-full rounded border-slate-300 text-sm focus:border-admin-primary focus:ring-admin-primary">{{ old('description', $category->description ?? '') }}</textarea>
    </div>

    <div>
        <label class="mb-1 block text-sm font-semibold text-slate-700">Upload Image</label>
        <input type="file" name="image" accept="image/*" class="w-full text-sm text-slate-600">
    </div>

    <div>
        <label class="mb-1 block text-sm font-semibold text-slate-700">Or Image URL</label>
        <input type="url" name="image_url" value="{{ old('image_url') }}" placeholder="https://..."
            class="w-full rounded border-slate-300 text-sm focus:border-admin-primary focus:ring-admin-primary">
    </div>

    @if (!empty($category?->image))
        <div class="md:col-span-2">
            <p class="mb-1 text-sm font-semibold text-slate-700">Current Image</p>
            <img src="{{ $category->image }}" alt="" class="h-20 w-20 rounded object-cover border">
        </div>
    @endif
</div>

<div class="mt-6 flex gap-3">
    <button type="submit" class="rounded bg-admin-primary px-5 py-2 text-sm font-semibold text-white hover:bg-blue-600">Save</button>
    <a href="{{ route('admin.categories.index') }}" class="rounded border border-slate-300 px-5 py-2 text-sm font-semibold text-slate-600 hover:bg-slate-50">Cancel</a>
</div>
