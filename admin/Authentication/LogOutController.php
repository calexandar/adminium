<?php

declare(strict_types=1);

namespace Admin\Authentication;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

final class LogoutController
{
    public function __invoke(Request $request): JsonResponse
    {

        try {
            Auth::guard('web')->logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();

            return response()->json([
                'message' => 'Logout successful',
            ], Response::HTTP_OK);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());

            return response()->json([
                'message' => 'Error logging out',
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
