<?php

declare(strict_types=1);

namespace Admin\Authentication;

final readonly class SignInAdminCommand
{
    public function __construct(
        public string $email,
        public string $password,
    ) {}
}
