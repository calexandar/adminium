<?php

declare(strict_types=1);

namespace Admin\Categories;

use Illuminate\Foundation\Http\FormRequest;

final class CreateCategoryRequest extends FormRequest
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

            'title.en' => ['required', 'string', 'max:255'],
            'slug.en' => ['required', 'string', 'max:255', 'unique:'.Category::class],
            'description.en' => ['required', 'string', 'max:255'],
            'caption.en' => ['required',  'string', 'max:255'],
            'icon' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:1024'],
            'cover_image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:1024'],
            'meta_title.en' => ['required', 'string', 'max:255'],
            'meta_description.en' => ['required', 'string', 'max:255'],
            'meta_keywords.en' => ['required', 'string', 'max:255'],
        ];
    }
}
