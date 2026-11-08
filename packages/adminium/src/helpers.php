<?php

declare(strict_types=1);

use Calexandar\Adminium\Settings\SettingStore;

if (! function_exists('adminium_settings')) {
    /**
     * Resolve the Adminium settings store or read a single setting.
     *
     * @param  string|array<string, mixed>|null  $key
     */
    function adminium_settings(string|array|null $key = null, mixed $default = null): mixed
    {
        $store = app(SettingStore::class);

        if (is_null($key)) {
            return $store;
        }

        if (is_array($key)) {
            return $store->set($key);
        }

        return $store->get($key, $default);
    }
}
