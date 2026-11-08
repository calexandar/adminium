<?php

declare(strict_types=1);

namespace Calexandar\Adminium\Settings;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

final class SettingStore
{
    private string $group = 'default';

    /**
     * Select the settings group to read from or write to.
     */
    public function group(string $group): self
    {
        $this->group = $group;

        return $this;
    }

    /**
     * Get every setting in the current group as a key/value collection.
     *
     * @return Collection<string, mixed>
     */
    public function all(bool $fresh = false): Collection
    {
        if ($fresh) {
            return $this->query()->pluck('val', 'name');
        }

        /** @var Collection<string, mixed> $settings */
        $settings = Cache::rememberForever(
            $this->cacheKey(),
            fn (): Collection => $this->query()->pluck('val', 'name'),
        );

        return $settings;
    }

    /**
     * Get a single setting from the current group.
     */
    public function get(string $key, mixed $default = null, bool $fresh = false): mixed
    {
        return $this->all($fresh)->get($key, $default);
    }

    /**
     * Persist one or many settings in the current group.
     *
     * @param  string|array<string, mixed>  $key
     */
    public function set(string|array $key, mixed $value = null): mixed
    {
        if (is_array($key)) {
            foreach ($key as $name => $settingValue) {
                $this->set((string) $name, $settingValue);
            }

            return true;
        }

        $setting = $this->query()->firstOrNew([
            'name' => $key,
            'group' => $this->group,
        ]);

        $setting->setAttribute('val', $value);
        $setting->save();

        $this->flushCache();

        return $value;
    }

    /**
     * Determine whether a setting exists in the current group.
     */
    public function has(string $key): bool
    {
        return $this->all()->has($key);
    }

    /**
     * Remove a setting from the current group.
     */
    public function remove(string $key): int
    {
        $deleted = $this->query()->where('name', $key)->delete();

        $this->flushCache();

        return $deleted;
    }

    /**
     * Forget the cached settings for the current group.
     */
    public function flushCache(): void
    {
        Cache::forget($this->cacheKey());
    }

    /**
     * @return Builder<Setting>
     */
    private function query(): Builder
    {
        return Setting::query()->where('group', $this->group);
    }

    private function cacheKey(): string
    {
        return 'adminium.settings.'.$this->group;
    }
}
