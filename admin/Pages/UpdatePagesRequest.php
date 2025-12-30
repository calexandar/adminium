<?php

declare(strict_types=1);

namespace Admin\Pages;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class UpdatePagesRequest extends FormRequest
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
            'slug' => ['required', 'string', 'max:255', Rule::unique(Page::class)->ignore($this->route()->parameter('page'))],
            'content.*' => ['required', 'string', 'max:16777215'],
            'subtitle.*' => ['required', 'string', 'max:255'],
            'cover_image' => ['image', 'mimes:jpeg,png,jpg,gif,webp,avif', 'max:1024'],
            'meta_title.*' => ['required', 'string', 'max:60'],
            'meta_description.*' => ['required', 'string', 'max:160'],
            'published' => ['required', 'boolean'],
            'in_menu' => ['required', 'boolean'],
            'privacy_policy' => ['required', 'boolean'],
        ];
    }
}
