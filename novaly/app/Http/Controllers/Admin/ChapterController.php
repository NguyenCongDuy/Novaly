<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreChapterRequest;
use App\Http\Requests\UpdateChapterRequest;
use App\Models\Chapter;
use App\Models\Story;
use Illuminate\Support\Facades\DB;

class ChapterController extends Controller
{
    /**
     * Display a listing of chapters for the given story.
     */
    public function index(Story $story)
    {
        $chapters = $story->chapters()
            ->orderBy('chapter_number')
            ->paginate(15);

        return view('admin.stories.chapters.index', compact('story', 'chapters'));
    }

    /**
     * Show the form for creating a new chapter.
     */
    public function create(Story $story)
    {
        return view('admin.stories.chapters.create', compact('story'));
    }

    /**
     * Store a newly created chapter in storage.
     */
    public function store(StoreChapterRequest $request, Story $story)
    {
        DB::transaction(function () use ($request, $story) {
            $nextChapterNumber = $story->chapters()
                ->lockForUpdate()
                ->max('chapter_number');

            $story->chapters()->create([
                'chapter_number' => $nextChapterNumber ? $nextChapterNumber + 1 : 1,
                'title' => $request->title,
                'access_type' => $request->access_type,
                'coin_price' => $request->access_type === 'coin' ? $request->coin_price : null,
                'money_price' => $request->access_type === 'premium' ? $request->money_price : null,
                'view_count' => 0,
            ]);
        });

        return redirect()
            ->route('admin.stories.chapters.index', $story->id)
            ->with('success', 'Thêm chương mới thành công!');
    }

    /**
     * Show the form for editing the specified chapter.
     */
    public function edit(Story $story, Chapter $chapter)
    {
        abort_if($chapter->story_id !== $story->id, 404);

        return view('admin.stories.chapters.edit', compact('story', 'chapter'));
    }

    /**
     * Update the specified chapter in storage.
     */
    public function update(UpdateChapterRequest $request, Story $story, Chapter $chapter)
    {
        abort_if($chapter->story_id !== $story->id, 404);

        $chapter->update([
            'title' => $request->title,
            'access_type' => $request->access_type,
            'coin_price' => $request->access_type === 'coin' ? $request->coin_price : null,
            'money_price' => $request->access_type === 'premium' ? $request->money_price : null,
        ]);

        $content = trim($request->input('content', ''));

        $chapter->content()->updateOrCreate(
            ['chapter_id' => $chapter->id],
            ['content' => $content === '' ? null : $content]
        );

        return redirect()
            ->route('admin.stories.chapters.index', $story->id)
            ->with('success', 'Cập nhật chương thành công!');
    }

    /**
     * Remove the specified chapter from storage.
     */
    public function destroy(Story $story, Chapter $chapter)
    {
        abort_if($chapter->story_id !== $story->id, 404);

        $chapter->delete();

        return redirect()
            ->route('admin.stories.chapters.index', $story->id)
            ->with('success', 'Xóa chương thành công!');
    }
}
