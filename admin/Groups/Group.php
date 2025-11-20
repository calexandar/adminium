<?php

declare(strict_types=1);

namespace Admin\Groups;

use Illuminate\Database\Eloquent\Model;
use Kra8\Snowflake\HasShortflakePrimary;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

final class Group extends Model implements HasMedia
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
        'meta_title',
        'meta_description',
        'meta_keywords',
        'order',
        'published',
    ];
}
