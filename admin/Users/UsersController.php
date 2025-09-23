<?php

declare(strict_types=1);

namespace Admin\Users;

use Admin\UserManagment\User;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;

final readonly class UsersController
{
    public function index(): View
    {
        $users = User::with('roles')->get();

        return view('users::index', with([
            'users' => $users,
        ]));
    }

    public function edit(string $user): View
    {
        $user = User::find($user);
        $permissions = Permission::all()->pluck('name');

        return view('users::edit', with([
            'user' => $user,
            'permissions' => $permissions
        ]));
    }
}
