<?php

declare(strict_types=1);

namespace Admin\Products;

use Admin\Categories\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Kra8\Snowflake\HasShortflakePrimary;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

final class Product extends Model implements HasMedia
{
    use HasShortflakePrimary, HasTranslations, InteractsWithMedia;

    /**
     * The attributes that are translatable.
     *
     * @var list<string>
     */
    public array $translatable = [
        'title',
        'description',
        'caption',
        'disclaimer',
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
        'category_id',
        'title',
        'slug',
        'description',
        'caption',
        'disclaimer',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'order',
        'enabled',
        'new_product',
        'published',
    ];

    /**
     * Get the category that this product belongs to.
     *
     * @return BelongsTo<Category, Product>
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class); //@phpstan-ignore-line
    }
}
