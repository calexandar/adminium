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

if (! function_exists('adminium_locales')) {
    /**
     * Resolve the locales offered by the Adminium translatable fields.
     *
     * @return array<int, string>
     */
    function adminium_locales(): array
    {
        $locales = config('app.available_locales') ?? config('adminium.available_locales', ['en']);

        if (! is_array($locales)) {
            return ['en'];
        }

        $locales = array_values(array_filter(
            $locales,
            static fn (mixed $locale): bool => is_string($locale) && $locale !== '',
        ));

        return $locales === [] ? ['en'] : $locales;
    }
}

if (! function_exists('adminium_logo')) {
    /**
     * Resolve the public URL for the configured Adminium logo.
     */
    function adminium_logo(): ?string
    {
        $logo = config('adminium.logo');

        if (! is_string($logo) || $logo === '') {
            return null;
        }

        return file_exists(public_path($logo)) ? asset($logo) : null;
    }
}
