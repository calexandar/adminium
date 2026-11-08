<?php

declare(strict_types=1);

namespace Calexandar\Adminium\Console;

use Calexandar\Adminium\Database\Seeders\PermissionSeeder;
use Calexandar\Adminium\Database\Seeders\RoleSeeder;
use Calexandar\Adminium\Database\Seeders\SuperAdminSeeder;
use Illuminate\Console\Command;
use Spatie\MediaLibrary\MediaLibraryServiceProvider;
use Spatie\Permission\PermissionServiceProvider;

final class InstallCommand extends Command
{
    protected $signature = 'adminium:install
        {--force : Overwrite existing published files}
        {--migrate : Run the database migrations after publishing}
        {--seed : Seed the roles, permissions and super admin user}';

    protected $description = 'Install the Adminium admin panel';

    public function handle(): int
    {
        $this->publishConfig();
        $this->publishAssets();
        $this->publishDependencyMigrations();
        $this->linkStorage();

        if ((bool) $this->option('migrate')) {
            $this->call('migrate', ['--force' => true]);
        }

        if ((bool) $this->option('seed')) {
            $this->seed();
        }

        $this->newLine();
        $this->info('Adminium was installed successfully.');
        $this->newLine();
        $this->line('Next steps:');
        $this->line('  1. Run: php artisan migrate');
        $this->line('  2. Run: php artisan db:seed --class="Calexandar\Adminium\Database\Seeders\RoleSeeder"');
        $this->line('  3. Run: php artisan db:seed --class="Calexandar\Adminium\Database\Seeders\PermissionSeeder"');
        $this->line('  4. Run: php artisan db:seed --class="Calexandar\Adminium\Database\Seeders\SuperAdminSeeder"');
        $this->line('  5. Add the Adminium entries to vite.config.js:');
        $this->line("       'vendor/calexandar/adminium/resources/css/adminium.css',");
        $this->line("       'vendor/calexandar/adminium/resources/js/adminium.js',");
        $this->line('  6. Run: npm install && npm run build');
        $this->line('  7. Sign in at /'.config('adminium.route_prefix', 'admin').'/sign-in with superadmin@gmail.com / password');

        return self::SUCCESS;
    }

    private function publishConfig(): void
    {
        $this->call('vendor:publish', [
            '--tag' => 'adminium-config',
            '--force' => (bool) $this->option('force'),
        ]);
    }

    private function publishAssets(): void
    {
        $this->call('vendor:publish', [
            '--tag' => 'adminium-assets',
            '--force' => (bool) $this->option('force'),
        ]);
    }

    private function publishDependencyMigrations(): void
    {
        if (! $this->hasMigration('create_permission_tables')) {
            $this->call('vendor:publish', [
                '--provider' => PermissionServiceProvider::class,
                '--tag' => 'permission-migrations',
            ]);
        }

        if (! $this->hasMigration('create_media_table')) {
            $this->call('vendor:publish', [
                '--provider' => MediaLibraryServiceProvider::class,
                '--tag' => 'medialibrary-migrations',
            ]);
        }
    }

    private function linkStorage(): void
    {
        if (file_exists(public_path('storage'))) {
            $this->line('Storage link already exists.');

            return;
        }

        $this->call('storage:link');
    }

    private function seed(): void
    {
        $this->call('db:seed', ['--class' => RoleSeeder::class, '--force' => true]);
        $this->call('db:seed', ['--class' => PermissionSeeder::class, '--force' => true]);
        $this->call('db:seed', ['--class' => SuperAdminSeeder::class, '--force' => true]);
    }

    private function hasMigration(string $name): bool
    {
        return glob(database_path('migrations/*_'.$name.'.php')) !== [];
    }
}
