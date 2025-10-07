<?php

declare(strict_types=1);

namespace Database\Seeders;

use Admin\UserManagment\User;
use Illuminate\Database\Seeder;

final class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::query()->create([
            'name' => 'Super Admin',
            'title' => 'Full Access',
            'email' => 'superadmin@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ]);
        $user->assignRole('super_admin');
    }
}
