<div class="grid gap-5 md:grid-cols-2">
    <div class="md:col-span-2">
        <label class="mb-1 block text-sm font-semibold text-slate-700">Title *</label>
        <input type="text" name="title" value="{{ old('title', $product->title ?? '') }}" required
            class="w-full rounded border-slate-300 text-sm focus:border-admin-primary focus:ring-admin-primary">
    </div>

    <div>
        <label class="mb-1 block text-sm font-semibold text-slate-700">Category *</label>
        <select name="category_id" required class="w-full rounded border-slate-300 text-sm focus:border-admin-primary focus:ring-admin-primary">
            <option value="">Select category</option>
            @foreach ($categories as $cat)
                <option value="{{ $cat['id'] }}" @selected(old('category_id', $product->category_id ?? '') == $cat['id'])>{{ $cat['title'] }}</option>
            @endforeach
        </select>
        <p class="mt-1 text-xs text-slate-500">One category per product (Category hasMany Products).</p>
    </div>

    <div>
        <label class="mb-1 block text-sm font-semibold text-slate-700">Slug</label>
        <input type="text" name="slug" value="{{ old('slug', $product->slug ?? '') }}"
            class="w-full rounded border-slate-300 text-sm focus:border-admin-primary focus:ring-admin-primary">
    </div>

    <div>
        <label class="mb-1 block text-sm font-semibold text-slate-700">Price *</label>
        <input type="number" step="0.01" min="0" name="price" value="{{ old('price', $product->price ?? '') }}" required
            class="w-full rounded border-slate-300 text-sm focus:border-admin-primary focus:ring-admin-primary">
    </div>

    <div>
        <label class="mb-1 block text-sm font-semibold text-slate-700">Original Price</label>
        <input type="number" step="0.01" min="0" name="original_price" value="{{ old('original_price', $product->original_price ?? '') }}"
            class="w-full rounded border-slate-300 text-sm focus:border-admin-primary focus:ring-admin-primary">
    </div>

    <div>
        <label class="mb-1 block text-sm font-semibold text-slate-700">Stock *</label>
        <input type="number" min="0" name="stock" value="{{ old('stock', $product->stock ?? 0) }}" required
            class="w-full rounded border-slate-300 text-sm focus:border-admin-primary focus:ring-admin-primary">
    </div>

    <div>
        <label class="mb-1 block text-sm font-semibold text-slate-700">Brand</label>
        <input type="text" name="brand" value="{{ old('brand', $product->brand ?? 'E-SHOP') }}"
            class="w-full rounded border-slate-300 text-sm focus:border-admin-primary focus:ring-admin-primary">
    </div>

    <div>
        <label class="mb-1 block text-sm font-semibold text-slate-700">Discount %</label>
        <input type="number" min="0" max="100" name="discount_percent" value="{{ old('discount_percent', $product->discount_percent ?? '') }}"
            class="w-full rounded border-slate-300 text-sm focus:border-admin-primary focus:ring-admin-primary">
    </div>

    <div>
        <label class="mb-1 block text-sm font-semibold text-slate-700">Status *</label>
        <select name="status" required class="w-full rounded border-slate-300 text-sm focus:border-admin-primary focus:ring-admin-primary">
            <option value="active" @selected(old('status', $product->status ?? 'active') === 'active')>Active</option>
            <option value="inactive" @selected(old('status', $product->status ?? '') === 'inactive')>Inactive</option>
        </select>
    </div>

    <div>
        <label class="mb-1 block text-sm font-semibold text-slate-700">Keywords</label>
        <input type="text" name="keywords" value="{{ old('keywords', $product->keywords ?? '') }}"
            class="w-full rounded border-slate-300 text-sm focus:border-admin-primary focus:ring-admin-primary">
    </div>

    <div class="md:col-span-2 flex flex-wrap gap-6">
        <label class="flex items-center gap-2 text-sm"><input type="checkbox" name="is_new" value="1" @checked(old('is_new', $product->is_new ?? false))> New</label>
        <label class="flex items-center gap-2 text-sm"><input type="checkbox" name="is_featured" value="1" @checked(old('is_featured', $product->is_featured ?? false))> Featured</label>
        <label class="flex items-center gap-2 text-sm"><input type="checkbox" name="is_deal" value="1" @checked(old('is_deal', $product->is_deal ?? false))> Deal</label>
    </div>

    <div class="md:col-span-2">
        <label class="mb-1 block text-sm font-semibold text-slate-700">Description</label>
        <textarea name="description" id="summernote-description" rows="2" class="summernote w-full rounded border-slate-300 text-sm">{{ old('description', $product->description ?? '') }}</textarea>
    </div>

    <div class="md:col-span-2">
        <label class="mb-1 block text-sm font-semibold text-slate-700">Detail</label>
        <textarea name="detail" id="summernote-detail" rows="4" class="summernote w-full rounded border-slate-300 text-sm">{{ old('detail', $product->detail ?? '') }}</textarea>
    </div>

    <div>
        <label class="mb-1 block text-sm font-semibold text-slate-700">Main Image {{ isset($product) ? '' : '*' }}</label>
        <input type="file" name="image" accept="image/*" class="w-full text-sm text-slate-600 file:mr-3 file:rounded file:border-0 file:bg-admin-primary file:px-3 file:py-1.5 file:text-sm file:font-semibold file:text-white">
        <p class="mt-1 text-xs text-slate-500">Max 2MB — storage/app/public/products</p>
    </div>

    <div>
        <label class="mb-1 block text-sm font-semibold text-slate-700">Or Image URL</label>
        <input type="url" name="image_url" value="{{ old('image_url') }}" placeholder="https://..."
            class="w-full rounded border-slate-300 text-sm focus:border-admin-primary focus:ring-admin-primary">
    </div>

    @if (!empty($product?->image))
        <div class="md:col-span-2">
            <p class="mb-1 text-sm font-semibold text-slate-700">Current Main Image</p>
            <img src="{{ $product->image }}" alt="" class="h-24 w-24 rounded border object-cover">
        </div>
    @endif

    <div class="md:col-span-2">
        <label class="mb-1 block text-sm font-semibold text-slate-700">Image Gallery</label>
        <input type="file" name="gallery[]" accept="image/*" multiple
            class="w-full text-sm text-slate-600 file:mr-3 file:rounded file:border-0 file:bg-slate-600 file:px-3 file:py-1.5 file:text-sm file:font-semibold file:text-white">
        <p class="mt-1 text-xs text-slate-500">Select multiple images for product gallery (ProductImage).</p>

        @if (!empty($product?->images) && $product->images->isNotEmpty())
            <div class="mt-4 grid grid-cols-2 gap-3 sm:grid-cols-4 md:grid-cols-6">
                @foreach ($product->images as $galleryImage)
                    <div class="relative rounded border p-1">
                        <img src="{{ $galleryImage->image }}" alt="" class="h-20 w-full rounded object-cover">
                        <form action="{{ route('admin.products.images.destroy', [$product->id, $galleryImage->id]) }}" method="POST" class="mt-1">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full rounded bg-red-500 py-0.5 text-[10px] font-semibold text-white hover:bg-red-600" onclick="return confirm('Remove this image?')">Remove</button>
                        </form>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>

<div class="mt-6 flex gap-3">
    <button type="submit" class="rounded bg-admin-primary px-5 py-2 text-sm font-semibold text-white hover:bg-blue-600">Save</button>
    <a href="{{ route('admin.products.index') }}" class="rounded border border-slate-300 px-5 py-2 text-sm font-semibold text-slate-600 hover:bg-slate-50">Cancel</a>
</div>

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.css" rel="stylesheet">
@endpush

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.js"></script>
    <script>
        $('.summernote').summernote({
            height: 160,
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview']]
            ]
        });
    </script>
@endpush
