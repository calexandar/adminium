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

            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'unique:'.Category::class],
            'description' => ['required', 'string', 'max:255'],
            'caption' => ['required', 'string', 'max:255'],
            // 'icon' => ['required', 'string', 'max:255'],
            'cover_image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:1024'],
            'meta_title' => ['required', 'string', 'max:255'],
            'meta_description' => ['required', 'string', 'max:255'],
            'meta_keywords' => ['required', 'string', 'max:255'],
        ];
    }
}
