<?php

declare(strict_types=1);

namespace Admin\Authentication\SignIn;

use Admin\UserManagment\UserGetByEmail;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Validation\ValidationException;

final readonly class SignInAdminCommandHandler
{
    public function __construct(
        private UserGetByEmail $userGetByEmail,
        private Dispatcher $eventDispatcher,
        private StatefulGuard $statefulGuard
    ) {}

    public function handle(SignInAdminCommand $signInAdminCommand): int
    {

        if (! $this->statefulGuard->attempt(['email' => $signInAdminCommand->email, 'password' => $signInAdminCommand->password])
        ) {
            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }
        $user = ($this->userGetByEmail)($signInAdminCommand->email);

        $this->eventDispatcher->dispatch(
            new AdminSignedIn(
                $user->id,
            )
        );

        return $user->id;

    }
}
