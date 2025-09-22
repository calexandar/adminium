<?php

declare(strict_types=1);

namespace Admin\Users;

use Illuminate\View\View;
use Admin\UserManagment\User;

final readonly class UsersController
{
    public function index(): View
    {
        $users = User::with('roles')->get();

        return view('users::index', with([
            'users' => $users
        ]));
    }

    public function edit(string $user): View
    {
        $user = User::find($user);

        return view('users::edit', with([
            'user' => $user
        ]));
    }
}
