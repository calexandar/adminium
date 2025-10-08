<?php

declare(strict_types=1);

namespace Admin\Categories;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

final class Category extends Model
{
    use HasTranslations;

    /**
     * The attributes that are translatable.
     *
     * @var list<string>
     */
    public array $translatable = [
        'title',
        'description',
        'caption',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'title',
        'slug',
        'description',
        'caption',
        'icon',
        'cover_image',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'order',
        'enabled',
    ];

    protected static function boot()
    {
        parent::boot();

        self::creating(function ($category) {
            $category->slug = $category->generateUniqueSlug($category->title);
        });

        self::updating(function ($category) {
            if ($category->isDirty('title')) {
                $category->slug = $category->generateUniqueSlug($category->title, $category->id);
            }
        });
    }
}
