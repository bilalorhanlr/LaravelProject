<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Services\ImageUploadService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function __construct(private ImageUploadService $images) {}

    public function index(): View
    {
        return view('admin.products.index', [
            'products' => Product::with('category')->latest()->paginate(15),
        ]);
    }

    public function show(int $id): View
    {
        $product = Product::with(['category', 'images', 'comments.user'])->findOrFail($id);

        return view('admin.products.show', compact('product'));
    }

    public function create(): View
    {
        return view('admin.products.create', [
            'categories' => Category::nestedOptions(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:products,slug'],
            'keywords' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'detail' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'original_price' => ['nullable', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'brand' => ['nullable', 'string', 'max:100'],
            'image' => ['nullable', 'image', 'max:2048'],
            'image_url' => ['nullable', 'url', 'max:500'],
            'gallery' => ['nullable', 'array'],
            'gallery.*' => ['image', 'max:2048'],
            'status' => ['required', 'in:active,inactive'],
            'is_new' => ['boolean'],
            'is_featured' => ['boolean'],
            'is_deal' => ['boolean'],
            'discount_percent' => ['nullable', 'integer', 'min:0', 'max:100'],
        ]);

        $slug = $validated['slug'] ?? Str::slug($validated['title']);
        $slug = $this->uniqueSlug($slug);

        $image = $this->images->store($request->file('image'), $validated['image_url'] ?? null, 'products');
        if (! $image) {
            return back()->withInput()->with('error', 'Product image is required (upload or URL).');
        }

        $product = Product::create([
            'category_id' => $validated['category_id'],
            'title' => $validated['title'],
            'slug' => $slug,
            'keywords' => $validated['keywords'] ?? null,
            'description' => $validated['description'] ?? null,
            'detail' => $validated['detail'] ?? null,
            'price' => $validated['price'],
            'original_price' => $validated['original_price'] ?? null,
            'image' => $image,
            'quantity' => $validated['stock'],
            'stock' => $validated['stock'],
            'brand' => $validated['brand'] ?? 'E-SHOP',
            'status' => $validated['status'],
            'is_new' => $request->boolean('is_new'),
            'is_featured' => $request->boolean('is_featured'),
            'is_deal' => $request->boolean('is_deal'),
            'discount_percent' => $validated['discount_percent'] ?? null,
            'rating' => 0,
            'review_count' => 0,
        ]);

        $this->storeGalleryImages($product, $request->file('gallery', []));

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
    }

    public function edit(int $id): View
    {
        return view('admin.products.edit', [
            'product' => Product::with('images')->findOrFail($id),
            'categories' => Category::nestedOptions(),
        ]);
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $product = Product::with('images')->findOrFail($id);

        $validated = $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:products,slug,'.$id],
            'keywords' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'detail' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'original_price' => ['nullable', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'brand' => ['nullable', 'string', 'max:100'],
            'image' => ['nullable', 'image', 'max:2048'],
            'image_url' => ['nullable', 'url', 'max:500'],
            'gallery' => ['nullable', 'array'],
            'gallery.*' => ['image', 'max:2048'],
            'status' => ['required', 'in:active,inactive'],
            'is_new' => ['boolean'],
            'is_featured' => ['boolean'],
            'is_deal' => ['boolean'],
            'discount_percent' => ['nullable', 'integer', 'min:0', 'max:100'],
        ]);

        $slug = $validated['slug'] ?? Str::slug($validated['title']);
        if ($slug !== $product->slug) {
            $slug = $this->uniqueSlug($slug, $id);
        }

        $image = $product->image;
        if ($request->hasFile('image') || ! empty($validated['image_url'])) {
            $this->images->delete($product->image);
            $image = $this->images->store($request->file('image'), $validated['image_url'] ?? null, 'products') ?? $product->image;
        }

        $product->update([
            'category_id' => $validated['category_id'],
            'title' => $validated['title'],
            'slug' => $slug,
            'keywords' => $validated['keywords'] ?? null,
            'description' => $validated['description'] ?? null,
            'detail' => $validated['detail'] ?? null,
            'price' => $validated['price'],
            'original_price' => $validated['original_price'] ?? null,
            'image' => $image,
            'quantity' => $validated['stock'],
            'stock' => $validated['stock'],
            'brand' => $validated['brand'] ?? 'E-SHOP',
            'status' => $validated['status'],
            'is_new' => $request->boolean('is_new'),
            'is_featured' => $request->boolean('is_featured'),
            'is_deal' => $request->boolean('is_deal'),
            'discount_percent' => $validated['discount_percent'] ?? null,
        ]);

        $this->storeGalleryImages($product, $request->file('gallery', []));

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $product = Product::with('images')->findOrFail($id);

        $this->images->delete($product->image);
        foreach ($product->images as $galleryImage) {
            $this->images->delete($galleryImage->image);
        }

        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
    }

    public function destroyImage(int $id, int $imageId): RedirectResponse
    {
        $product = Product::findOrFail($id);
        $image = ProductImage::where('product_id', $product->id)->findOrFail($imageId);

        $this->images->delete($image->image);
        $image->delete();

        return back()->with('success', 'Gallery image removed.');
    }

    /**
     * @param  array<int, \Illuminate\Http\UploadedFile>|null  $files
     */
    private function storeGalleryImages(Product $product, ?array $files): void
    {
        if (empty($files)) {
            return;
        }

        foreach ($this->images->storeMany($files, 'products/gallery') as $url) {
            $product->images()->create(['image' => $url]);
        }
    }

    private function uniqueSlug(string $slug, ?int $exceptId = null): string
    {
        $original = $slug;
        $counter = 1;

        while (Product::where('slug', $slug)->when($exceptId, fn ($q) => $q->where('id', '!=', $exceptId))->exists()) {
            $slug = $original.'-'.$counter++;
        }

        return $slug;
    }
}
