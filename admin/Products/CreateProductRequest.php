<?php

declare(strict_types=1);

namespace Admin\Products;

use Illuminate\Foundation\Http\FormRequest;

final class CreateProductRequest extends FormRequest
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
            'slug' => ['required', 'string', 'max:255', 'unique:'.Product::class],
            'description.*' => ['required', 'string', 'max:255'],
            'caption.*' => ['required',  'string', 'max:255'],
            'disclaimer.*' => ['required',  'string', 'max:255'],
            'icon' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:1024'],
            'cover_image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:1024'],
            'meta_title.*' => ['required', 'string', 'max:255'],
            'meta_description.*' => ['required', 'string', 'max:255'],
            'meta_keywords.*' => ['required', 'string', 'max:255'],
        ];
    }
}
