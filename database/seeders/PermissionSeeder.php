<?php

declare(strict_types=1);

namespace Database\Seeders;

use Admin\UserManagment\UserPermissionName;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

final class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (UserPermissionName::cases() as $permission) {
            Permission::create(['name' => $permission->value, 'guard_name' => 'web']);
        }
    }
}
