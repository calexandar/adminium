<?php

declare(strict_types=1);

namespace Database\Seeders;

use Calexandar\Adminium\Database\Seeders\PermissionSeeder;
use Calexandar\Adminium\Database\Seeders\RoleSeeder;
use Calexandar\Adminium\Database\Seeders\SuperAdminSeeder;
use Illuminate\Database\Seeder;

final class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            PermissionSeeder::class,
            SuperAdminSeeder::class,
        ]);
    }
}
