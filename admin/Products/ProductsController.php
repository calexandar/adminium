<?php

declare(strict_types=1);

namespace Admin\Products;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Admin\Categories\Category;
use Illuminate\Http\RedirectResponse;

final readonly class ProductsController
{
    public function index(): View
    {
        $products = Product::query()
            ->orderBy('order', 'asc')
            ->paginate(10);   

        return view('products::index', compact('products'));
    }

    public function create(): View
    {
        $categories = Category::all(); 
        
        return view('products::create', compact('categories'));
    }

    public function store(CreateProductRequest $request): RedirectResponse
    {
        $product = Product::create([
            'category_id' => $request->integer('category_id'),
            'title' => $request->array('title'),
            'slug' => $request->string('slug'),
            'description' => $request->array('description'),
            'caption' => $request->array('caption'),
            'disclaimer' => $request->array('disclaimer'),
            'meta_title' => $request->array('meta_title'),
            'meta_description' => $request->array('meta_description'),
            'meta_keywords' => $request->array('meta_keywords'),
        ]);

        $product->addMediaFromRequest('icon')->toMediaCollection('icons');
        $product->addMediaFromRequest('cover_image')->toMediaCollection('products');

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully');
    }

    public function edit(string $category): View
    {
        $category = Category::find($category);

        return view('categories::edit', compact('category'));
    }

    public function update(UpdateCategoryRequest $request, string $category): RedirectResponse
    {
        $category = Category::find($category);

        $category->fill($request->validated());

        if ($request->hasFile('icon')) {
            $category->clearMediaCollection('icons');
            $category->addMediaFromRequest('icon')->toMediaCollection('icons');
        }

        if ($request->hasFile('cover_image')) {
            $category->clearMediaCollection('categories');
            $category->addMediaFromRequest('cover_image')->toMediaCollection('categories');
        }

        $category->save();

        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully');
    }

    public function destroy(string $category): RedirectResponse
    {
        $category = Category::find($category);

        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully');
    }

    public function reorder(Request $request): RedirectResponse
    {
        $order = $request->input('order');

        foreach ($order as $item) {
            // Find the item in your database by its ID and update its order
            Category::where('id', $item['id'])->update(['order' => $item['order']]);
        }

        return redirect()->route('admin.categories.index');
    }
}
