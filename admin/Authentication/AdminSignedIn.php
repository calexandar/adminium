<?php

declare(strict_types=1);

namespace Admin\Authentication;

final readonly class AdminSignedIn
{
    public function __construct(
        public int $userId,
    ) {}
}
