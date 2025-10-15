<?php

declare(strict_types=1);

namespace Admin\Categories;

use Admin\UserManagment\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

final readonly class CategoriesController
{
    public function index(): View
    {
        $categories = Category::paginate(10);

        return view('categories::index', compact('categories'));
    }

    public function create(): View
    {
        return view('categories::create');
    }

    public function store(CreateCategoryRequest $request): RedirectResponse
    {

        $category = Category::create([
            'title' => $request->string('title'),
            'slug' => $request->string('slug'),
            'description' => $request->string('description'),
            'caption' => $request->string('caption'),
            'meta_title' => $request->string('meta_title'),
            'meta_description' => $request->string('meta_description'),
            'meta_keywords' => $request->string('meta_keywords'),
        ]);

        $category->addMediaFromRequest('cover_image')->toMediaCollection('categories');

        return redirect()->route('admin.categories.index');
    }

    public function edit(string $category): View
    {
        $category = Category::find($category);

        return view('categories::edit', compact('category'));
    }

    public function update(UpdateCategoryRequest $request, string $category): RedirectResponse
    {
        $category = Category::find($category);



        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully');
    }

    public function destroy(string $user): RedirectResponse
    {
        $user = User::find($user);

        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully');
    }
}
