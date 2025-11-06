<?php

declare(strict_types=1);

namespace Admin\Products;

use Admin\Categories\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

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

    public function edit(string $product): View
    {
        $product = Product::find($product);
        $categories = Category::all();

        return view('products::edit', compact('product', 'categories'));
    }

    public function update(UpdateProductRequest $request, string $product): RedirectResponse
    {
        $product = Product::find($product);

        $product->fill($request->validated());

        if ($request->hasFile('icon')) {
            $product->clearMediaCollection('icons');
            $product->addMediaFromRequest('icon')->toMediaCollection('icons');
        }

        if ($request->hasFile('cover_image')) {
            $product->clearMediaCollection('products');
            $product->addMediaFromRequest('cover_image')->toMediaCollection('products');
        }

        $product->save();

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully');
    }

    public function destroy(string $product): RedirectResponse
    {
        $product = Product::find($product);

        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully');
    }

    public function reorder(Request $request): RedirectResponse
    {
        $order = $request->input('order');

        foreach ($order as $item) {
            // Find the item in your database by its ID and update its order
            Product::where('id', $item['id'])->update(['order' => $item['order']]);
        }

        return redirect()->route('admin.products.index');
    }
}
