<?php

declare(strict_types=1);

namespace Admin\Media;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

final readonly class MediaController
{
    public function index(): View
    {
        $media = Media::query()
            ->orderBy('order', 'asc')
            ->paginate(10);

        return view('media::index', compact('media'));
    }

    public function create(): View
    {
        return view('media::create');
    }

    public function store(CreateMediaRequest $request): RedirectResponse
    {

        $media = Media::create([
            'title' => $request->array('title'),
            'slug' => $request->string('slug'),
            'description' => $request->array('description'),
            'caption' => $request->array('caption'),
            'meta_title' => $request->array('meta_title'),
            'meta_description' => $request->array('meta_description'),
        ]);

        $media->addMediaFromRequest('media_file')->toMediaCollection('media');

        return redirect()->route('admin.media.index')->with('success', 'Media created successfully');
    }

    public function edit(string $media): View
    {
        $media = Media::find($media);

        return view('media::edit', compact('media'));
    }

    public function update(UpdateMediaRequest $request, string $media): RedirectResponse
    {
        $media = Media::find($media);

        $media->fill($request->validated());

        if ($request->hasFile('media_file')) {
            $media->clearMediaCollection('media');
            $media->addMediaFromRequest('media_file')->toMediaCollection('media');
        }

        $media->save();

        return redirect()->route('admin.media.index')->with('success', 'Media updated successfully');
    }

    public function destroy(string $media): RedirectResponse
    {
        $media = Media::find($media);

        $media->delete();

        return redirect()->route('admin.media.index')->with('success', 'Media deleted successfully');
    }

    public function reorder(Request $request): RedirectResponse
    {
        $order = $request->input('order');

        foreach ($order as $item) {
            // Find the item in your database by its ID and update its order
            Media::where('id', $item['id'])->update(['order' => $item['order']]);
        }

        return redirect()->route('admin.media.index');
    }
}
