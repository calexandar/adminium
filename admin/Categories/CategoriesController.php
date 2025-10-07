<?php

declare(strict_types=1);

namespace Admin\Categories;

use Admin\UserManagment\User;
use Admin\UserManagment\UserRoleName;
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

        $user = User::create([
            'name' => $request->string('name'),
            'title' => $request->string('title'),
            'email' => $request->string('email'),
            'password' => $request->string('password'),
        ]);

        $selectedPermissions = $request->input('permissions', []);

        $user->syncPermissions($selectedPermissions);

        $user->assignRole(UserRoleName::ADMIN->value);

        return redirect()->route('admin.users.index');
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
