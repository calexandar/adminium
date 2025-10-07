<?php

declare(strict_types=1);

namespace Admin\UserManagment;

enum UserRoleName: string
{
    case SUPER_ADMIN = 'super_admin';
    case ADMIN = 'admin';

    public function label(): string
    {
        return match ($this) {
            self::SUPER_ADMIN => 'Super Admin',
            self::ADMIN => 'Admin',
        };
    }
}
