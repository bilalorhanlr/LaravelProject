<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        return view('admin.products.index', [
            'products' => Product::with('category')->latest()->paginate(10),
        ]);
    }

    public function create(): View
    {
        return view('admin.products.create', [
            'categories' => Category::orderBy('title')->get(),
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
            'status' => ['required', 'in:active,inactive'],
            'is_new' => ['boolean'],
            'is_featured' => ['boolean'],
            'is_deal' => ['boolean'],
            'discount_percent' => ['nullable', 'integer', 'min:0', 'max:100'],
        ]);

        $slug = $validated['slug'] ?? Str::slug($validated['title']);
        $slug = $this->uniqueSlug($slug);

        $image = $this->resolveImage($request, $validated['image_url'] ?? null, 'products');
        if (! $image) {
            return back()->withInput()->with('error', 'Product image is required (upload or URL).');
        }

        Product::create([
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

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
    }

    public function edit(int $id): View
    {
        return view('admin.products.edit', [
            'product' => Product::findOrFail($id),
            'categories' => Category::orderBy('title')->get(),
        ]);
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $product = Product::findOrFail($id);

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
            $this->deleteStoredImage($product->image);
            $image = $this->resolveImage($request, $validated['image_url'] ?? null, 'products') ?? $product->image;
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

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $product = Product::findOrFail($id);
        $this->deleteStoredImage($product->image);
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
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

    private function resolveImage(Request $request, ?string $url, string $folder): ?string
    {
        if ($request->hasFile('image')) {
            return Storage::disk('public')->url($request->file('image')->store($folder, 'public'));
        }

        return $url;
    }

    private function deleteStoredImage(?string $path): void
    {
        if (! $path || ! str_contains($path, '/storage/')) {
            return;
        }

        $relative = str_replace('/storage/', '', parse_url($path, PHP_URL_PATH) ?? '');
        Storage::disk('public')->delete($relative);
    }
}
