<?php

declare(strict_types=1);

namespace Admin\Settings;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

final readonly class SettingsController
{
    public function index(string $group): View
    {
        $fields = config('settings.' . $group . '.fields');

        return view('settings::index', compact('fields', 'group'));
    }


    public function store(string $group, Request $request): RedirectResponse
    {
        $data = $request->all();

        foreach ($data as $key => $value) {
            settings()->group($group)->set($key, $value);
        }

        return redirect()->route('admin.settings.index', $group)->withSuccess('You have successfully saved settings!');
    }

}
