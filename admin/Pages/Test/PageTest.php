<?php

declare(strict_types=1);

namespace Admin\Pages\Test;

use Admin\Pages\Page;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class);

test('page can be created with fillable attributes', function () {
    $page = Page::factory()->create([
        'slug' => 'test-page',
        'published' => true,
        'in_menu' => false,
        'privacy_policy' => false,
        'order' => 1,
    ]);

    expect($page->slug)->toBe('test-page');
    expect($page->published)->toBeTrue();
    expect($page->in_menu)->toBeFalse();
    expect($page->privacy_policy)->toBeFalse();
    expect($page->order)->toBe(1);
});

test('page has correct table name', function () {
    $page = Page::factory()->create();
    expect($page->getTable())->toBe('pages');
});

test('page uses shortflake primary key', function () {
    $page = Page::factory()->create();
    expect($page->getKey())->toBeString();
    expect($page->getKey())->toHaveLength(8);
});

test('page has translatable attributes', function () {
    $page = Page::factory()->create([
        'title' => ['en' => 'English Title', 'es' => 'Título en Español'],
        'content' => ['en' => 'English Content', 'es' => 'Contenido en Español'],
        'subtitle' => ['en' => 'English Subtitle', 'es' => 'Subtítulo en Español'],
        'meta_title' => ['en' => 'English Meta Title', 'es' => 'Título Meta en Español'],
        'meta_description' => ['en' => 'English Meta Description', 'es' => 'Descripción Meta en Español'],
    ]);

    expect($page->getTranslation('title', 'en'))->toBe('English Title');
    expect($page->getTranslation('title', 'es'))->toBe('Título en Español');
    expect($page->getTranslation('content', 'en'))->toBe('English Content');
    expect($page->getTranslation('content', 'es'))->toBe('Contenido en Español');
    expect($page->getTranslation('subtitle', 'en'))->toBe('English Subtitle');
    expect($page->getTranslation('subtitle', 'es'))->toBe('Subtítulo en Español');
    expect($page->getTranslation('meta_title', 'en'))->toBe('English Meta Title');
    expect($page->getTranslation('meta_title', 'es'))->toBe('Título Meta en Español');
    expect($page->getTranslation('meta_description', 'en'))->toBe('English Meta Description');
    expect($page->getTranslation('meta_description', 'es'))->toBe('Descripción Meta en Español');
});

test('page implements has media interface', function () {
    $page = Page::factory()->create();

    expect($page)->toBeInstanceOf(\Spatie\MediaLibrary\HasMedia::class);
});

test('page boots cache clearing on save', function () {
    Cache::fake();

    $page = Page::factory()->create();

    Cache::shouldReceive('forget')->with('nav_pages')->once();
    $page->title = ['en' => 'Updated Title'];
    $page->save();
});

test('page boots cache clearing on delete', function () {
    Cache::fake();

    $page = Page::factory()->create();

    Cache::shouldReceive('forget')->with('nav_pages')->once();
    $page->delete();
});

test('page translatable attributes are correct', function () {
    $page = new Page();

    expect($page->translatable)->toBe([
        'title',
        'content',
        'subtitle',
        'meta_title',
        'meta_description',
    ]);
});

test('page fillable attributes are correct', function () {
    $page = new Page();

    expect($page->getFillable())->toBe([
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
    ]);
});

test('page can be ordered correctly', function () {
    $page3 = Page::factory()->create(['order' => 3]);
    $page1 = Page::factory()->create(['order' => 1]);
    $page2 = Page::factory()->create(['order' => 2]);

    $pages = Page::query()->orderBy('order', 'asc')->get();

    expect($pages[0]->id)->toBe($page1->id);
    expect($pages[1]->id)->toBe($page2->id);
    expect($pages[2]->id)->toBe($page3->id);
});

test('page can handle boolean fields', function () {
    $page = Page::factory()->create([
        'published' => true,
        'in_menu' => true,
        'privacy_policy' => false,
    ]);

    expect($page->published)->toBeTrue();
    expect($page->in_menu)->toBeTrue();
    expect($page->privacy_policy)->toBeFalse();

    $page->update([
        'published' => false,
        'in_menu' => false,
        'privacy_policy' => true,
    ]);

    expect($page->published)->toBeFalse();
    expect($page->in_menu)->toBeFalse();
    expect($page->privacy_policy)->toBeTrue();
});
