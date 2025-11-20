<?php

declare(strict_types=1);

namespace Admin\News;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

final readonly class NewsController
{
    public function index(): View
    {
        $news = News::query()
            ->orderBy('order', 'asc')
            ->paginate(10);

        return view('news::index', compact('news'));
    }

    public function create(): View
    {
        return view('news::create');
    }

    public function store(CreateNewsRequest $request): RedirectResponse
    {

        $news = News::create([
            'title' => $request->array('title'),
            'slug' => $request->string('slug'),
            'description' => $request->array('description'),
            'caption' => $request->array('caption'),
            'meta_title' => $request->array('meta_title'),
            'meta_description' => $request->array('meta_description'),
            'meta_keywords' => $request->array('meta_keywords'),
        ]);

        $news->addMediaFromRequest('icon')->toMediaCollection('icons');
        $news->addMediaFromRequest('cover_image')->toMediaCollection('news');

        return redirect()->route('admin.news.index')->with('success', 'News created successfully');
    }

    public function edit(string $news): View
    {
        $news = News::find($news);

        return view('news::edit', compact('news'));
    }

    public function update(UpdateNewsRequest $request, string $news): RedirectResponse
    {
        $news = News::find($news);

        $news->fill($request->validated());

        if ($request->hasFile('icon')) {
            $news->clearMediaCollection('icons');
            $news->addMediaFromRequest('icon')->toMediaCollection('icons');
        }

        if ($request->hasFile('cover_image')) {
            $news->clearMediaCollection('news');
            $news->addMediaFromRequest('cover_image')->toMediaCollection('news');
        }

        $news->save();

        return redirect()->route('admin.news.index')->with('success', 'News updated successfully');
    }

    public function destroy(string $news): RedirectResponse
    {
        $news = News::find($news);

        $news->delete();

        return redirect()->route('admin.news.index')->with('success', 'News deleted successfully');
    }

    public function reorder(Request $request): RedirectResponse
    {
        $order = $request->input('order');

        foreach ($order as $item) {
            // Find the item in your database by its ID and update its order
            News::where('id', $item['id'])->update(['order' => $item['order']]);
        }

        return redirect()->route('admin.news.index');
    }
}
