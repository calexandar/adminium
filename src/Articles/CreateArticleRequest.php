<?php

declare(strict_types=1);

namespace Calexandar\Adminium\Articles;

use Illuminate\Foundation\Http\FormRequest;

final class CreateArticleRequest extends FormRequest
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
            'slug' => ['required', 'string', 'max:255', 'unique:'.Article::class],
            'content.*' => ['required', 'string', 'max:10000'],
            'short_description.*' => ['required',  'string', 'max:255'],
            'cover_image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg,webp,avif', 'max:1024'],
            'meta_title.*' => ['required', 'string', 'max:60'],
            'meta_description.*' => ['required', 'string', 'max:160'],
            'published' => ['boolean'],
            'group_id' => ['required', 'integer'],
            'author_id' => ['required', 'integer'],
        ];
    }
}
