<?php

declare(strict_types=1);

namespace Admin\Authentication;

final readonly class SignInAdminController
{
    public function __construct(private SignInAdminCommandHandler $signInAdminCommandHandler) {}

    public function __invoke(AdminSignInRequest $request): void
    {
        $userId = $this->signInAdminCommandHandler->handle(
            new SignInAdminCommand(
                $request->string('email')->value(),
                $request->string('password')->value(),
            )
        );

    }
}
