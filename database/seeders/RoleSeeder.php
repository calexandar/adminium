<?php

declare(strict_types=1);

namespace Database\Seeders;

use Admin\UserManagement\UserRoleName;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

final class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (UserRoleName::cases() as $role) {
            Role::create(['name' => $role->value, 'guard_name' => 'web']);
        }
    }
}
