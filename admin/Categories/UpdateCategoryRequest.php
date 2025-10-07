<?php

declare(strict_types=1);

namespace Admin\Categories;

use Admin\UserManagment\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class UpdateCategoryRequest extends FormRequest
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

            'name' => ['required', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                // Rule::unique(User::class)->ignore(request()->user()),
            ],
            'permissions' => ['required', 'array'],
        ];
    }
}
