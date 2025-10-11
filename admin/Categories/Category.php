<?php

declare(strict_types=1);

namespace Admin\Categories;

use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Kra8\Snowflake\HasShortflakePrimary;
use Spatie\Translatable\HasTranslations;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

final class Category extends Model implements HasMedia
{
    use HasTranslations, InteractsWithMedia, HasShortflakePrimary;

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

    // protected static function boot()
    // {
    //     parent::boot();

    //     self::creating(function ($category) {
    //         $category->slug = $category->generateUniqueSlug($category->title);
    //     });

    //     self::updating(function ($category) {
    //         if ($category->isDirty('title')) {
    //             $category->slug = $category->generateUniqueSlug($category->title, $category->id);
    //         }
    //     });
    // }

    //     public function registerMediaConversions(?Media $media = null): void
    // {
    //     $this
    //         ->addMediaConversion('preview')
    //         ->fit(Fit::Contain, 300, 300)
    //         ->nonQueued();
    // }
}
