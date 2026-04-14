<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStoryRequest;
use App\Http\Requests\UpdateStoryRequest;
use App\Models\Story;
use App\Models\Author;
use App\Models\Genre;
use Illuminate\Container\Attributes\DB;
use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class StoryController extends Controller
{
    public function index()
    {
        $stories = Story::with('author', 'genres')
            ->latest()
            ->paginate(15);

        return view('admin.stories.index', compact('stories'));
    }

    public function create()
    {
        $authors = Author::all();
        $genres = Genre::all();

        return view('admin.stories.create', compact('authors', 'genres'));
    }

    public function store(StoreStoryRequest $request)
    {
        $data = $request->only(['title', 'slug', 'description', 'author_id', 'status']);

        $data['slug'] = $request->slug ?? Str::slug($request->title);
        $originalSlug = $data['slug'];
        $count = 1;
        while (Story::where('slug', $data['slug'])->exists()) {
            $data['slug'] = $originalSlug . '-' . $count++;
        }

        if ($request->hasFile('avatar')) {
            $data['avatar_url'] = $request->file('avatar')->store('stories', 'public');
        }

        if ($request->hasFile('cover')) {
            $data['cover_url'] = $request->file('cover')->store('stories', 'public');
        }

        $story = Story::create($data);

        if ($request->genre_ids) {
            $story->genres()->sync($request->genre_ids);
        }

        return redirect()->route('admin.stories.index')
            ->with('success', 'Thêm truyện thành công!');
    }

    public function edit(Story $story)
    {
        $authors = Author::all();
        $genres = Genre::all();

        return view('admin.stories.edit', compact('story', 'authors', 'genres'));
    }

    public function update(UpdateStoryRequest $request, Story $story)
    {
        $data = $request->only(['title', 'slug', 'description', 'author_id', 'status']);

        $data['slug'] = $request->slug ?? Str::slug($request->title);
        $originalSlug = $data['slug'];
        $count = 1;
        while (
            Story::where('slug', $data['slug'])
            ->where('id', '!=', $story->id)
            ->exists()
        ) {
            $data['slug'] = $originalSlug . '-' . $count++;
        }

        if ($request->hasFile('avatar')) {
            $data['avatar_url'] = $request->file('avatar')->store('stories', 'public');
        }

        if ($request->hasFile('cover')) {
            $data['cover_url'] = $request->file('cover')->store('stories', 'public');
        }

        $story->update($data);

        if ($request->genre_ids) {
            $story->genres()->sync($request->genre_ids);
        } else {
            $story->genres()->detach();
        }

        return redirect()->route('admin.stories.index')
            ->with('success', 'Cập nhật truyện thành công!');
    }

    public function show(Story $story)
    {
        $story->load('author', 'genres', 'chapters');

        return view('admin.stories.show', compact('story'));
    }
    public function destroy(Story $story)
{
    // Xóa ảnh avatar
    if ($story->avatar_url && Storage::disk('public')->exists($story->avatar_url)) {
        Storage::disk('public')->delete($story->avatar_url);
    }

    // Xóa ảnh cover
    if ($story->cover_url && Storage::disk('public')->exists($story->cover_url)) {
        Storage::disk('public')->delete($story->cover_url);
    }

    // Xóa liên kết genres (pivot)
    $story->genres()->detach();

    $story->forceDelete();

    return redirect()
        ->route('admin.stories.index')
        ->with('success', 'Xóa vĩnh viễn truyện thành công!');
}
}
