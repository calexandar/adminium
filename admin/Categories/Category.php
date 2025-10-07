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
        'image_title',
        'image_alt_text',
        'meta_keywords',
        'meta_description',
        'meta_title',
        'homepage_image',
        'caption',
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
        'order',
        'enabled',
        'image',
        'image_title',
        'image_alt_text',
        'meta_keywords',
        'meta_description',
        'meta_title',
        'homepage_image',
        'logo_image',
        'caption',
        'icon',
    ];

     protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($category) {
            $category->slug = $category->generateUniqueSlug($category->title);
        });
        
        static::updating(function ($category) {
            if ($category->isDirty('title')) {
                $category->slug = $category->generateUniqueSlug($category->title, $category->id);
            }
        });
    }
}
