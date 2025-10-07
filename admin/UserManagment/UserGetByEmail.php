<?php

declare(strict_types=1);

namespace Admin\UserManagment;

final class UserGetByEmail
{
    public function __construct(private User $user) {}

    public function __invoke(string $email): User
    {
        return $this->user->newQuery()->where('email', $email)->firstOrFail();
    }
}
