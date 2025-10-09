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

        return view('categories::index');
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
            // 'icon' => $request->string('icon'),
            'cover_image' => $request->string('cover_image'),
            'meta_title' => $request->string('meta_title'),
            'meta_description' => $request->string('meta_description'),
            'meta_keywords' => $request->string('meta_keywords'),
        ]);

        return redirect()->route('admin.categories.index');
    }

    public function edit(string $user): View
    {
        $user = User::find($user);

        return view('users::edit', compact('user'));
    }

    public function update(UpdateCategoryRequest $request, string $user): RedirectResponse
    {
        $user = User::find($user);

        $user->name = $request->string('name');
        $user->title = $request->string('title');
        $user->email = $request->string('email');

        $user->update();

        $selectedPermissions = $request->input('permissions', []);

        $user->syncPermissions($selectedPermissions);

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully');
    }

    public function destroy(string $user): RedirectResponse
    {
        $user = User::find($user);

        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully');
    }
}
