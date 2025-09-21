<?php

declare(strict_types=1);

namespace Admin\UserManagment;

use Illuminate\View\View;

final readonly class UserController
{
    public function __invoke(): View
    {
        return view('authentication::sign_in');
    }
}
