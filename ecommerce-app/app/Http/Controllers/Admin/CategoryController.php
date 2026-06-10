<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Services\ImageUploadService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function __construct(private ImageUploadService $images) {}

    public function index(): View
    {
        return view('admin.categories.index', [
            'categories' => Category::with('parent')
                ->withCount('children', 'products')
                ->orderBy('sort_order')
                ->orderBy('title')
                ->paginate(15),
        ]);
    }

    public function tree(): View
    {
        $roots = Category::roots()
            ->with(['children' => function ($q) {
                $q->withCount('products')
                    ->with(['children' => fn ($q2) => $q2->withCount('products')->orderBy('sort_order')->orderBy('title')])
                    ->orderBy('sort_order')
                    ->orderBy('title');
            }])
            ->withCount('products')
            ->orderBy('sort_order')
            ->orderBy('title')
            ->get();

        return view('admin.categories.tree', compact('roots'));
    }

    public function show(int $id): View
    {
        $category = Category::with(['parent', 'children', 'products'])
            ->withCount('products')
            ->findOrFail($id);

        return view('admin.categories.show', compact('category'));
    }

    public function create(): View
    {
        return view('admin.categories.create', [
            'parentOptions' => Category::nestedOptions(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'parent_id' => ['nullable', 'exists:categories,id'],
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:categories,slug'],
            'keywords' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'max:2048'],
            'image_url' => ['nullable', 'url', 'max:500'],
            'status' => ['required', 'in:active,inactive'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $slug = $validated['slug'] ?? Str::slug($validated['title']);
        $slug = $this->uniqueSlug($slug);

        Category::create([
            'parent_id' => $validated['parent_id'] ?? null,
            'title' => $validated['title'],
            'slug' => $slug,
            'keywords' => $validated['keywords'] ?? null,
            'description' => $validated['description'] ?? null,
            'image' => $this->images->store($request->file('image'), $validated['image_url'] ?? null, 'categories'),
            'status' => $validated['status'],
            'sort_order' => $validated['sort_order'] ?? 0,
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully.');
    }

    public function edit(int $id): View
    {
        $category = Category::findOrFail($id);

        return view('admin.categories.edit', [
            'category' => $category,
            'parentOptions' => Category::nestedOptions($id),
        ]);
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $category = Category::findOrFail($id);

        $validated = $request->validate([
            'parent_id' => ['nullable', 'exists:categories,id', 'not_in:'.$id],
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:categories,slug,'.$id],
            'keywords' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'max:2048'],
            'image_url' => ['nullable', 'url', 'max:500'],
            'status' => ['required', 'in:active,inactive'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $slug = $validated['slug'] ?? Str::slug($validated['title']);
        if ($slug !== $category->slug) {
            $slug = $this->uniqueSlug($slug, $id);
        }

        $image = $category->image;
        if ($request->hasFile('image') || ! empty($validated['image_url'])) {
            $this->images->delete($category->image);
            $image = $this->images->store($request->file('image'), $validated['image_url'] ?? null, 'categories');
        }

        $category->update([
            'parent_id' => $validated['parent_id'] ?? null,
            'title' => $validated['title'],
            'slug' => $slug,
            'keywords' => $validated['keywords'] ?? null,
            'description' => $validated['description'] ?? null,
            'image' => $image,
            'status' => $validated['status'],
            'sort_order' => $validated['sort_order'] ?? 0,
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $category = Category::findOrFail($id);

        if ($category->products()->exists()) {
            return back()->with('error', 'Cannot delete: category has products. Move or delete products first.');
        }

        $category->children()->each(fn (Category $child) => $child->delete());
        $this->images->delete($category->image);
        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully.');
    }

    private function uniqueSlug(string $slug, ?int $exceptId = null): string
    {
        $original = $slug;
        $counter = 1;

        while (Category::where('slug', $slug)->when($exceptId, fn ($q) => $q->where('id', '!=', $exceptId))->exists()) {
            $slug = $original.'-'.$counter++;
        }

        return $slug;
    }
}
