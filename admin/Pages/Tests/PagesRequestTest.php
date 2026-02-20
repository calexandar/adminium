<?php

declare(strict_types=1);

namespace Admin\Pages\Tests;

use Admin\Pages\CreatePagesRequest;
use Admin\Pages\Page;
use Admin\Pages\UpdatePagesRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class);

test('create pages request authorizes all users', function () {
    $request = new CreatePagesRequest();
    expect($request->authorize())->toBeTrue();
});

test('create pages request has correct validation rules', function () {
    $request = new CreatePagesRequest();
    $rules = $request->rules();

    expect($rules)->toHaveKey('title.*');
    expect($rules)->toHaveKey('slug');
    expect($rules)->toHaveKey('content.*');
    expect($rules)->toHaveKey('subtitle.*');
    expect($rules)->toHaveKey('cover_image');
    expect($rules)->toHaveKey('meta_title.*');
    expect($rules)->toHaveKey('meta_description.*');
    expect($rules)->toHaveKey('published');
    expect($rules)->toHaveKey('in_menu');
    expect($rules)->toHaveKey('privacy_policy');
});

test('create pages request validates title required', function () {
    $request = new CreatePagesRequest();

    $request->merge([
        'title' => [],
        'slug' => 'test-page',
        'content' => ['en' => 'Test content'],
        'subtitle' => ['en' => 'Test subtitle'],
        'cover_image' => UploadedFile::fake()->image('cover.jpg'),
        'meta_title' => ['en' => 'Test Meta Title'],
        'meta_description' => ['en' => 'Test meta description'],
    ]);

    expect($request->validate($request->rules()))->toThrow('Validation failed');
});

test('create pages request validates slug required', function () {
    $request = new CreatePagesRequest();

    $request->merge([
        'title' => ['en' => 'Test Title'],
        'content' => ['en' => 'Test content'],
        'subtitle' => ['en' => 'Test subtitle'],
        'cover_image' => UploadedFile::fake()->image('cover.jpg'),
        'meta_title' => ['en' => 'Test Meta Title'],
        'meta_description' => ['en' => 'Test meta description'],
    ]);

    expect($request->validate($request->rules()))->toThrow('Validation failed');
});

test('create pages request validates slug unique', function () {
    $page = Page::factory()->create(['slug' => 'existing-page']);

    $request = new CreatePagesRequest();

    $request->merge([
        'title' => ['en' => 'Test Title'],
        'slug' => 'existing-page',
        'content' => ['en' => 'Test content'],
        'subtitle' => ['en' => 'Test subtitle'],
        'cover_image' => UploadedFile::fake()->image('cover.jpg'),
        'meta_title' => ['en' => 'Test Meta Title'],
        'meta_description' => ['en' => 'Test meta description'],
    ]);

    expect($request->validate($request->rules()))->toThrow('Validation failed');
});

test('create pages request validates cover image required', function () {
    $request = new CreatePagesRequest();

    $request->merge([
        'title' => ['en' => 'Test Title'],
        'slug' => 'test-page',
        'content' => ['en' => 'Test content'],
        'subtitle' => ['en' => 'Test subtitle'],
        'meta_title' => ['en' => 'Test Meta Title'],
        'meta_description' => ['en' => 'Test meta description'],
    ]);

    expect($request->validate($request->rules()))->toThrow('Validation failed');
});

test('create pages request validates cover image file types', function () {
    $request = new CreatePagesRequest();

    $request->merge([
        'title' => ['en' => 'Test Title'],
        'slug' => 'test-page',
        'content' => ['en' => 'Test content'],
        'subtitle' => ['en' => 'Test subtitle'],
        'cover_image' => UploadedFile::fake()->create('document.pdf'),
        'meta_title' => ['en' => 'Test Meta Title'],
        'meta_description' => ['en' => 'Test meta description'],
    ]);

    expect($request->validate($request->rules()))->toThrow('Validation failed');
});

test('create pages request validates meta title length', function () {
    $request = new CreatePagesRequest();

    $request->merge([
        'title' => ['en' => 'Test Title'],
        'slug' => 'test-page',
        'content' => ['en' => 'Test content'],
        'subtitle' => ['en' => 'Test subtitle'],
        'cover_image' => UploadedFile::fake()->image('cover.jpg'),
        'meta_title' => ['en' => str_repeat('a', 61)],
        'meta_description' => ['en' => 'Test meta description'],
    ]);

    expect($request->validate($request->rules()))->toThrow('Validation failed');
});

test('create pages request validates meta description length', function () {
    $request = new CreatePagesRequest();

    $request->merge([
        'title' => ['en' => 'Test Title'],
        'slug' => 'test-page',
        'content' => ['en' => 'Test content'],
        'subtitle' => ['en' => 'Test subtitle'],
        'cover_image' => UploadedFile::fake()->image('cover.jpg'),
        'meta_title' => ['en' => 'Test Meta Title'],
        'meta_description' => ['en' => str_repeat('a', 161)],
    ]);

    expect($request->validate($request->rules()))->toThrow('Validation failed');
});

test('create pages request passes with valid data', function () {
    $request = new CreatePagesRequest();

    $request->merge([
        'title' => ['en' => 'Test Title'],
        'slug' => 'test-page',
        'content' => ['en' => 'Test content'],
        'subtitle' => ['en' => 'Test subtitle'],
        'cover_image' => UploadedFile::fake()->image('cover.jpg'),
        'meta_title' => ['en' => 'Test Meta Title'],
        'meta_description' => ['en' => 'Test meta description'],
        'published' => true,
        'in_menu' => false,
        'privacy_policy' => false,
    ]);

    expect($request->validate($request->rules()))->toBeArray();
});

test('update pages request authorizes all users', function () {
    $request = new UpdatePagesRequest();
    expect($request->authorize())->toBeTrue();
});

test('update pages request has correct validation rules', function () {
    $page = Page::factory()->create();
    $request = UpdatePagesRequest::create('/admin/pages/'.$page->id, 'PUT', []);
    $rules = $request->rules();

    expect($rules)->toHaveKey('title.*');
    expect($rules)->toHaveKey('slug');
    expect($rules)->toHaveKey('content.*');
    expect($rules)->toHaveKey('subtitle.*');
    expect($rules)->toHaveKey('cover_image');
    expect($rules)->toHaveKey('meta_title.*');
    expect($rules)->toHaveKey('meta_description.*');
    expect($rules)->toHaveKey('published');
    expect($rules)->toHaveKey('in_menu');
    expect($rules)->toHaveKey('privacy_policy');
});

test('update pages request validates cover image optional', function () {
    $page = Page::factory()->create();

    $request = UpdatePagesRequest::create('/admin/pages/'.$page->id, 'PUT', [
        'title' => ['en' => 'Updated Title'],
        'slug' => 'updated-page',
        'content' => ['en' => 'Updated content'],
        'subtitle' => ['en' => 'Updated subtitle'],
        'meta_title' => ['en' => 'Updated Meta Title'],
        'meta_description' => ['en' => 'Updated meta description'],
        'published' => true,
        'in_menu' => false,
        'privacy_policy' => false,
    ]);

    expect($request->validate($request->rules()))->toBeArray();
});

test('update pages request validates published required', function () {
    $page = Page::factory()->create();

    $request = UpdatePagesRequest::create('/admin/pages/'.$page->id, 'PUT', [
        'title' => ['en' => 'Updated Title'],
        'slug' => 'updated-page',
        'content' => ['en' => 'Updated content'],
        'subtitle' => ['en' => 'Updated subtitle'],
        'meta_title' => ['en' => 'Updated Meta Title'],
        'meta_description' => ['en' => 'Updated meta description'],
        'in_menu' => false,
        'privacy_policy' => false,
    ]);

    expect($request->validate($request->rules()))->toThrow('Validation failed');
});

test('update pages request validates in_menu required', function () {
    $page = Page::factory()->create();

    $request = UpdatePagesRequest::create('/admin/pages/'.$page->id, 'PUT', [
        'title' => ['en' => 'Updated Title'],
        'slug' => 'updated-page',
        'content' => ['en' => 'Updated content'],
        'subtitle' => ['en' => 'Updated subtitle'],
        'meta_title' => ['en' => 'Updated Meta Title'],
        'meta_description' => ['en' => 'Updated meta description'],
        'published' => true,
        'privacy_policy' => false,
    ]);

    expect($request->validate($request->rules()))->toThrow('Validation failed');
});

test('update pages request validates privacy_policy required', function () {
    $page = Page::factory()->create();

    $request = UpdatePagesRequest::create('/admin/pages/'.$page->id, 'PUT', [
        'title' => ['en' => 'Updated Title'],
        'slug' => 'updated-page',
        'content' => ['en' => 'Updated content'],
        'subtitle' => ['en' => 'Updated subtitle'],
        'meta_title' => ['en' => 'Updated Meta Title'],
        'meta_description' => ['en' => 'Updated meta description'],
        'published' => true,
        'in_menu' => false,
    ]);

    expect($request->validate($request->rules()))->toThrow('Validation failed');
});
