<?php

declare(strict_types=1);

namespace Admin\Authentication;

use Illuminate\View\View;


final readonly class SignInAdminViewController
{
   
    public function __invoke():  View
    {
        return view('auth.login');
    }
}
