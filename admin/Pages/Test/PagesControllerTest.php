<?php

declare(strict_types=1);

namespace Admin\Pages\Test;

use Admin\Pages\Page;
use Admin\UserManagment\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

use function Pest\Laravel\actingAs;

uses(TestCase::class, RefreshDatabase::class);

test('can view pages index', function () {
    Page::factory()->count(3)->create(['order' => 1]);

    actingAs(User::factory()->create())
        ->get(route('admin.pages.index'))
        ->assertSuccessful()
        ->assertViewIs('pages::index')
        ->assertViewHas('pages');
});

test('can create page form', function () {
    actingAs(User::factory()->create())
        ->get(route('admin.pages.create'))
        ->assertSuccessful()
        ->assertViewIs('pages::create');
});

test('can store new page', function () {
    Cache::fake();

    $data = [
        'title' => ['en' => 'Test Page'],
        'slug' => 'test-page',
        'content' => ['en' => 'Test content'],
        'subtitle' => ['en' => 'Test subtitle'],
        'meta_title' => ['en' => 'Test Meta Title'],
        'meta_description' => ['en' => 'Test meta description'],
        'cover_image' => UploadedFile::fake()->image('cover.jpg'),
    ];

    actingAs(User::factory()->create())
        ->post(route('admin.pages.store'), $data)
        ->assertRedirect(route('admin.pages.index'))
        ->assertSessionHas('success', 'Page created successfully');

    expect(Page::where('slug', 'test-page')->exists())->toBeTrue();
});

test('can edit page', function () {
    $page = Page::factory()->create();

    actingAs(User::factory()->create())
        ->get(route('admin.pages.edit', $page))
        ->assertSuccessful()
        ->assertViewIs('pages::edit')
        ->assertViewHas('page', $page);
});

test('can update page', function () {
    $page = Page::factory()->create();

    $data = [
        'title' => ['en' => 'Updated Page'],
        'slug' => 'updated-page',
        'content' => ['en' => 'Updated content'],
        'subtitle' => ['en' => 'Updated subtitle'],
        'meta_title' => ['en' => 'Updated Meta Title'],
        'meta_description' => ['en' => 'Updated meta description'],
        'published' => true,
        'in_menu' => false,
        'privacy_policy' => false,
    ];

    actingAs(User::factory()->create())
        ->put(route('admin.pages.update', $page), $data)
        ->assertRedirect(route('admin.pages.index'))
        ->assertSessionHas('success', 'Page updated successfully');

    $page->refresh();
    expect($page->getTranslation('title', 'en'))->toBe('Updated Page');
});

test('can update page with new cover image', function () {
    $page = Page::factory()->create();
    $page->addMedia(UploadedFile::fake()->image('old-cover.jpg'))->toMediaCollection('pages');

    $data = [
        'title' => ['en' => 'Updated Page'],
        'slug' => 'updated-page',
        'content' => ['en' => 'Updated content'],
        'subtitle' => ['en' => 'Updated subtitle'],
        'meta_title' => ['en' => 'Updated Meta Title'],
        'meta_description' => ['en' => 'Updated meta description'],
        'published' => true,
        'in_menu' => false,
        'privacy_policy' => false,
        'cover_image' => UploadedFile::fake()->image('new-cover.jpg'),
    ];

    actingAs(User::factory()->create())
        ->put(route('admin.pages.update', $page), $data)
        ->assertRedirect(route('admin.pages.index'));

    expect($page->getMedia('pages'))->toHaveCount(1);
});

test('can delete page', function () {
    Cache::fake();

    $page = Page::factory()->create();

    actingAs(User::factory()->create())
        ->delete(route('admin.pages.destroy', $page))
        ->assertRedirect(route('admin.pages.index'))
        ->assertSessionHas('success', 'Page deleted successfully');

    expect(Page::find($page->id))->toBeNull();
});

test('can reorder pages', function () {
    $page1 = Page::factory()->create(['order' => 2]);
    $page2 = Page::factory()->create(['order' => 1]);

    $order = [
        ['id' => $page1->id, 'order' => 1],
        ['id' => $page2->id, 'order' => 2],
    ];

    actingAs(User::factory()->create())
        ->post(route('admin.pages.reorder'), ['order' => $order])
        ->assertRedirect(route('admin.pages.index'));

    $page1->refresh();
    $page2->refresh();

    expect($page1->order)->toBe(1);
    expect($page2->order)->toBe(2);
});
