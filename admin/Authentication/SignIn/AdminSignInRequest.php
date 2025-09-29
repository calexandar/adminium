<?php

declare(strict_types=1);

namespace Admin\Authentication\SignIn;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

final class AdminSignInRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {

        return [

            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
            ],
            'password' => ['required', Rules\Password::defaults()],
        ];
    }
}
