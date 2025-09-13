<?php

declare(strict_types=1);

namespace Admin\Authentication;

use Illuminate\Http\RedirectResponse;

final readonly class SignInAdminController
{
    public function __construct(private SignInAdminCommandHandler $signInAdminCommandHandler) {}

    public function __invoke(AdminSignInRequest $request):  RedirectResponse
    {
        $this->signInAdminCommandHandler->handle(
            new SignInAdminCommand(
                $request->string('email')->value(),
                $request->string('password')->value(),
            )
        );

        return redirect()->intended(route('dashboard', absolute: false));
    }
}
