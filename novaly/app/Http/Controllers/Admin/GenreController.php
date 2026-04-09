<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGenreRequest;
use App\Http\Requests\UpdateGenreRequest;
use App\Models\Genre;
use Illuminate\Support\Str;

class GenreController extends Controller
{
    /**
     * Hiển thị danh sách genres
     */
    public function index()
    {
        $genres = Genre::latest()->paginate(15);
        return view('admin.genres.index', compact('genres'));
    }

    /**
     * Hiển thị form tạo genre mới
     */
    public function create()
    {
        return view('admin.genres.create');
    }

    /**
     * Lưu genre mới vào database
     */
    public function store(StoreGenreRequest $request)
    {
        // slug tự động tạo từ name nếu không có
        $slug = $request->slug ?: Str::slug($request->name);

        Genre::create([
            'name' => $request->name,
            'slug' => $slug,
        ]);

        return redirect()->route('admin.genres.index')
            ->with('success', 'Thêm thể loại thành công!');
    }

    /**
     * Hiển thị form chỉnh sửa genre
     */
    public function edit(Genre $genre)
    {
        return view('admin.genres.edit', compact('genre'));
    }

    /**
     * Cập nhật genre vào database
     */
    public function update(UpdateGenreRequest $request, Genre $genre)
    {
        $slug = $request->slug ?: Str::slug($request->name);

        $genre->update([
            'name' => $request->name,
            'slug' => $slug,
        ]);

        return redirect()->route('admin.genres.index')
            ->with('success', 'Cập nhật thể loại thành công!');
    }

    /**
     * Xóa genre khỏi database
     */
    public function destroy(Genre $genre)
    {
        $genre->delete();

        return redirect()->route('admin.genres.index')
            ->with('success', 'Xóa thể loại thành công!');
    }
}
