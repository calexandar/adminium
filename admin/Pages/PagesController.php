<?php

declare(strict_types=1);

namespace Admin\Pages;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

final readonly class PagesController
{
    public function index(): View
    {
        $pages = Page::query()
            ->orderBy('order', 'asc')
            ->paginate(10);

        return view('pages::index', compact('pages'));
    }

    public function create(): View
    {
        return view('pages::create');
    }

    public function store(CreatePagesRequest $request): RedirectResponse
    {

        $page = Page::create([
            'title' => $request->array('title'),
            'slug' => $request->string('slug'),
            'content' => $request->array('content'),
            'subtitle' => $request->array('subtitle'),
            'meta_title' => $request->array('meta_title'),
            'meta_description' => $request->array('meta_description'),
        ]);

        $page->addMediaFromRequest('cover_image')->toMediaCollection('pages');

        return redirect()->route('admin.pages.index')->with('success', 'Page created successfully');
    }

    public function edit(string $page): View
    {
        $page = Page::find($page);

        return view('pages::edit', compact('page'));
    }

    public function update(UpdatePagesRequest $request, string $page): RedirectResponse
    {
        $page = Page::find($page);

        $page->fill($request->validated());

        if ($request->hasFile('cover_image')) {
            $page->clearMediaCollection('pages');
            $page->addMediaFromRequest('cover_image')->toMediaCollection('pages');
        }

        $page->save();

        return redirect()->route('admin.pages.index')->with('success', 'Page updated successfully');
    }

    public function destroy(string $page): RedirectResponse
    {
        $page = Page::find($page);

        $page->delete();

        return redirect()->route('admin.pages.index')->with('success', 'Page deleted successfully');
    }

    public function reorder(Request $request): RedirectResponse
    {
        $order = $request->input('order');

        foreach ($order as $item) {
            // Find the item in your database by its ID and update its order
            Page::where('id', $item['id'])->update(['order' => $item['order']]);
        }

        return redirect()->route('admin.pages.index');
    }
}
