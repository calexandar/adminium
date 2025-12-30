<?php

declare(strict_types=1);

namespace Admin\Groups;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

final readonly class GroupsController
{
    public function index(): View
    {
        $groups = Group::query()
            ->orderBy('order', 'asc')
            ->paginate(10);

        return view('groups::index', compact('groups'));
    }

    public function create(): View
    {
        return view('groups::create');
    }

    public function store(CreateGroupRequest $request): RedirectResponse
    {

        $group = Group::create([
            'title' => $request->array('title'),
            'slug' => $request->string('slug'),
            'description' => $request->array('description'),
            'caption' => $request->array('caption'),
        ]);

        $group->addMediaFromRequest('icon')->toMediaCollection('icons');

        return redirect()->route('admin.groups.index')->with('success', 'Group created successfully');
    }

    public function edit(string $group): View
    {
        $group = Group::find($group);

        return view('groups::edit', compact('group'));
    }

    public function update(UpdateGroupRequest $request, string $group): RedirectResponse
    {
        $group = Group::find($group);

        $group->fill($request->validated());

        if ($request->hasFile('icon')) {
            $group->clearMediaCollection('icons');
            $group->addMediaFromRequest('icon')->toMediaCollection('icons');
        }

        $group->save();

        return redirect()->route('admin.groups.index')->with('success', 'Group updated successfully');
    }

    public function destroy(string $group): RedirectResponse
    {
        $group = Group::find($group);

        $group->delete();

        return redirect()->route('admin.groups.index')->with('success', 'Group deleted successfully');
    }

    public function reorder(Request $request): RedirectResponse
    {
        $order = $request->input('order');

        foreach ($order as $item) {
            // Find the item in your database by its ID and update its order
            Group::where('id', $item['id'])->update(['order' => $item['order']]);
        }

        return redirect()->route('admin.groups.index');
    }
}
