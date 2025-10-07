<?php

declare(strict_types=1);

namespace Admin\Dashboard;

use Illuminate\View\View;

final readonly class DashboardController
{
    public function __invoke(): View
    {
        return view('dashboard::index');
    }
}
