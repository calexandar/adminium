<?php

declare(strict_types=1);

namespace Admin\Pages;

use Illuminate\Foundation\Http\FormRequest;

final class CreatePagesRequest extends FormRequest
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

            'title.*' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'unique:'.Page::class],
            'content.*' => ['required', 'string', 'max:16777215'],
            'subtitle.*' => ['required',  'string', 'max:255'],
            'cover_image' => ['required', 'file', 'mimes:jpeg,png,jpg,gif,webp,avif', 'max:1024'],
            'meta_title.*' => ['required', 'string', 'max:60'],
            'meta_description.*' => ['required', 'string', 'max:160'],
            'published' => ['boolean'],
            'in_menu' => ['boolean'],
            'privacy_policy' => ['boolean'],
        ];
    }
}
