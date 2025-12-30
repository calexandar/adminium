<?php

declare(strict_types=1);

namespace Admin\Pages;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Kra8\Snowflake\HasShortflakePrimary;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

final class Page extends Model implements HasMedia
{
    use HasShortflakePrimary, HasTranslations, InteractsWithMedia;

    protected $table = 'pages';

    /**
     * The attributes that are translatable.
     *
     * @var list<string>
     */
    public array $translatable = [
        'title',
        'content',
        'subtitle',
        'meta_title',
        'meta_description',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'title',
        'slug',
        'content',
        'subtitle',
        'meta_title',
        'meta_description',
        'order',
        'published',
        'in_menu',
        'privacy_policy',
    ];

    /**
     * Clear the cache automatically.
     *
     * @return void
     */
    protected static function booted()
    {
        self::saved(fn () => Cache::forget('nav_pages'));
        self::deleted(fn () => Cache::forget('nav_pages'));
    }
}
