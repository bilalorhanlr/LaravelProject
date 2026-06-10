<div class="grid gap-5 md:grid-cols-2">
    <div class="md:col-span-2">
        <label class="mb-1 block text-sm font-semibold text-slate-700">Title *</label>
        <input type="text" name="title" value="{{ old('title', $category->title ?? '') }}" required
            class="w-full rounded border-slate-300 text-sm focus:border-admin-primary focus:ring-admin-primary">
    </div>

    <div>
        <label class="mb-1 block text-sm font-semibold text-slate-700">Parent Category (Sub Category)</label>
        <select name="parent_id" class="w-full rounded border-slate-300 text-sm focus:border-admin-primary focus:ring-admin-primary">
            <option value="">— Main Category —</option>
            @foreach ($parentOptions as $option)
                <option value="{{ $option['id'] }}" @selected(old('parent_id', $category->parent_id ?? request('parent_id')) == $option['id'])>{{ $option['title'] }}</option>
            @endforeach
        </select>
        <p class="mt-1 text-xs text-slate-500">Select a parent to create a sub-category (one-to-many tree).</p>
    </div>

    <div>
        <label class="mb-1 block text-sm font-semibold text-slate-700">Slug</label>
        <input type="text" name="slug" value="{{ old('slug', $category->slug ?? '') }}" placeholder="auto-generated if empty"
            class="w-full rounded border-slate-300 text-sm focus:border-admin-primary focus:ring-admin-primary">
    </div>

    <div>
        <label class="mb-1 block text-sm font-semibold text-slate-700">Keywords</label>
        <input type="text" name="keywords" value="{{ old('keywords', $category->keywords ?? '') }}" placeholder="Computer Books, Php, Python"
            class="w-full rounded border-slate-300 text-sm focus:border-admin-primary focus:ring-admin-primary">
    </div>

    <div>
        <label class="mb-1 block text-sm font-semibold text-slate-700">Status *</label>
        <select name="status" required class="w-full rounded border-slate-300 text-sm focus:border-admin-primary focus:ring-admin-primary">
            <option value="active" @selected(old('status', $category->status ?? 'active') === 'active')>True (Active)</option>
            <option value="inactive" @selected(old('status', $category->status ?? '') === 'inactive')>False (Inactive)</option>
        </select>
    </div>

    <div>
        <label class="mb-1 block text-sm font-semibold text-slate-700">Sort Order</label>
        <input type="number" name="sort_order" min="0" value="{{ old('sort_order', $category->sort_order ?? 0) }}"
            class="w-full rounded border-slate-300 text-sm focus:border-admin-primary focus:ring-admin-primary">
    </div>

    <div class="md:col-span-2">
        <label class="mb-1 block text-sm font-semibold text-slate-700">Description</label>
        <textarea name="description" id="summernote-description" rows="4" class="summernote w-full rounded border-slate-300 text-sm">{{ old('description', $category->description ?? '') }}</textarea>
    </div>

    <div>
        <label class="mb-1 block text-sm font-semibold text-slate-700">Upload Image</label>
        <input type="file" name="image" accept="image/*" class="w-full text-sm text-slate-600 file:mr-3 file:rounded file:border-0 file:bg-admin-primary file:px-3 file:py-1.5 file:text-sm file:font-semibold file:text-white">
        <p class="mt-1 text-xs text-slate-500">Max 2MB. Stored in storage/app/public/categories</p>
    </div>

    <div>
        <label class="mb-1 block text-sm font-semibold text-slate-700">Or Image URL</label>
        <input type="url" name="image_url" value="{{ old('image_url') }}" placeholder="https://..."
            class="w-full rounded border-slate-300 text-sm focus:border-admin-primary focus:ring-admin-primary">
    </div>

    @if (!empty($category?->image))
        <div class="md:col-span-2">
            <p class="mb-1 text-sm font-semibold text-slate-700">Current Image</p>
            <img src="{{ $category->image }}" alt="" class="h-24 w-20 rounded border object-cover">
        </div>
    @endif
</div>

<div class="mt-6 flex gap-3">
    <button type="submit" class="rounded bg-admin-primary px-5 py-2 text-sm font-semibold text-white hover:bg-blue-600">Save</button>
    <a href="{{ route('admin.categories.index') }}" class="rounded border border-slate-300 px-5 py-2 text-sm font-semibold text-slate-600 hover:bg-slate-50">Cancel</a>
</div>

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.css" rel="stylesheet">
@endpush

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.js"></script>
    <script>
        $('#summernote-description').summernote({
            height: 180,
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['insert', ['link', 'picture']],
                ['view', ['codeview']]
            ]
        });
    </script>
@endpush
