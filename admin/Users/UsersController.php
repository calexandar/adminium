<?php

declare(strict_types=1);

namespace Admin\Users;

use Admin\UserManagment\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

final readonly class UsersController
{
    public function index(): View
    {
        $users = User::with('roles')->get();

        return view('users::index', compact('users'));
    }

    public function create(): View
    {
        return view('users::create');
    }

    public function store(Request $request): RedirectResponse
    {

        dd($request->all());

        return redirect()->route('admin.users.index');
    }

    public function edit(string $user): View
    {
        $user = User::find($user);

        return view('users::edit', compact('user'));
    }

    public function update(string $user): RedirectResponse
    {
        $user = User::find($user);

        $user->update(request()->all());

        $user->syncPermissions(request('permissions'));

        return redirect()->route('admin.users.index');
    }
}
