<?php

declare(strict_types=1);

namespace Calexandar\Adminium\Tests;

use Calexandar\Adminium\AdminiumServiceProvider;
use Kra8\Snowflake\Providers\LaravelServiceProvider as SnowflakeServiceProvider;
use Orchestra\Testbench\Attributes\WithMigration;
use Orchestra\Testbench\TestCase as BaseTestCase;
use Spatie\MediaLibrary\MediaLibraryServiceProvider;
use Spatie\Permission\PermissionServiceProvider;
use Spatie\Translatable\TranslatableServiceProvider;

#[WithMigration]
abstract class TestCase extends BaseTestCase
{
    /**
     * @return array<int, class-string>
     */
    protected function getPackageProviders($app): array
    {
        return [
            AdminiumServiceProvider::class,
            PermissionServiceProvider::class,
            MediaLibraryServiceProvider::class,
            SnowflakeServiceProvider::class,
            TranslatableServiceProvider::class,
        ];
    }

    protected function defineDatabaseMigrations(): void
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
    }
}
