<?php

declare(strict_types=1);

namespace Admin\Articles;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class UpdateArticleRequest extends FormRequest
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

            'group_id' => ['required', 'exists:groups,id'],
            'author_id' => ['required', 'exists:users,id'],
            'title.*' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', Rule::unique(Article::class)->ignore($this->route()->parameter('article'))],
            'content.*' => ['required', 'string', 'max:10000'],
            'short_description.*' => ['required', 'string', 'max:255'],
            'icon' => ['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:1024'],
            'cover_image' => ['image', 'mimes:jpeg,png,jpg,gif,svg,webp,avif', 'max:1024'],
            'meta_title.*' => ['required', 'string', 'max:60'],
            'meta_description.*' => ['required', 'string', 'max:160'],
            'published' => ['required', 'boolean'],
        ];
    }
}
