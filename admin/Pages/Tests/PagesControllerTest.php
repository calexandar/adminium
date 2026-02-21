<?php

declare(strict_types=1);

namespace Admin\Pages\Tests;

use Admin\Pages\Page;
use Admin\UserManagment\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

use function Pest\Laravel\actingAs;

uses(TestCase::class, RefreshDatabase::class);

test('can view pages index', function () {
    Role::query()->create(['name' => 'super_admin', 'guard_name' => 'web']);

    $user = User::query()->create([
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => bcrypt('password'),
    ]);
    $user->assignRole('super_admin');

    Page::query()->create([
        'title' => ['en' => 'Test Page'],
        'content' => ['en' => 'Test content'],
        'subtitle' => ['en' => 'Test subtitle'],
        'meta_title' => ['en' => 'Test meta title'],
        'meta_description' => ['en' => 'Test meta description'],
        'slug' => 'test-page-1',
        'published' => true,
        'order' => 1,
    ]);

    actingAs($user)
        ->get(route('admin.pages.index'))
        ->assertSuccessful()
        ->assertViewIs('pages::index')
        ->assertViewHas('pages');
});

test('can create page', function () {
    Role::query()->create(['name' => 'super_admin', 'guard_name' => 'web']);

    $user = User::query()->create([
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => bcrypt('password'),
    ]);
    $user->assignRole('super_admin');

    $data = [
        'title' => ['en' => 'Test Page'],
        'slug' => 'test-page',
        'content' => ['en' => 'Test content'],
        'subtitle' => ['en' => 'Test subtitle'],
        'meta_title' => ['en' => 'Test Meta Title'],
        'meta_description' => ['en' => 'Test meta description'],
        'cover_image' => UploadedFile::fake()->image('cover.jpg'),
    ];

    actingAs($user)
        ->post(route('admin.pages.store'), $data)
        ->assertRedirect(route('admin.pages.index'))
        ->assertSessionHas('success', 'Page created successfully');

    expect(Page::where('slug', 'test-page')->exists())->toBeTrue();
});

test('can update page', function () {
    Role::query()->create(['name' => 'super_admin', 'guard_name' => 'web']);

    $user = User::query()->create([
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => bcrypt('password'),
    ]);
    $user->assignRole('super_admin');

    $page = Page::query()->create([
        'title' => ['en' => 'Old Page'],
        'content' => ['en' => 'Old content'],
        'subtitle' => ['en' => 'Old subtitle'],
        'meta_title' => ['en' => 'Old meta title'],
        'meta_description' => ['en' => 'Old meta description'],
        'slug' => 'old-page',
        'published' => false,
        'in_menu' => false,
        'privacy_policy' => false,
    ]);

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

    actingAs($user)
        ->put(route('admin.pages.update', $page), $data)
        ->assertRedirect(route('admin.pages.index'))
        ->assertSessionHas('success', 'Page updated successfully');

    $page->refresh();
    expect($page->getTranslation('title', 'en'))->toBe('Updated Page');
});

test('can delete page', function () {
    Role::query()->create(['name' => 'super_admin', 'guard_name' => 'web']);

    $user = User::query()->create([
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => bcrypt('password'),
    ]);
    $user->assignRole('super_admin');

    $page = Page::query()->create([
        'title' => ['en' => 'Test Page'],
        'content' => ['en' => 'Test content'],
        'subtitle' => ['en' => 'Test subtitle'],
        'meta_title' => ['en' => 'Test meta title'],
        'meta_description' => ['en' => 'Test meta description'],
        'slug' => 'test-page',
        'published' => true,
    ]);

    actingAs($user)
        ->delete(route('admin.pages.destroy', $page))
        ->assertRedirect(route('admin.pages.index'))
        ->assertSessionHas('success', 'Page deleted successfully');

    expect(Page::find($page->id))->toBeNull();
});
