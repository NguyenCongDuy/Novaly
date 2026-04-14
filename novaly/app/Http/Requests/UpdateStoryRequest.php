<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|',
            'description' => 'nullable|string',
            'author_id' => 'nullable|exists:authors,id',
            'genre_ids' => 'nullable|array',
            'genre_ids.*' => 'exists:genres,id',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'status' => 'required|in:0,1',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Tiêu đề truyện là bắt buộc.',
            'title.string' => 'Tiêu đề phải là chuỗi ký tự.',
            'title.max' => 'Tiêu đề không được vượt quá 255 ký tự.',

            'slug.string' => 'Slug phải là chuỗi ký tự.',
            'slug.max' => 'Slug không được vượt quá 255 ký tự.',
            'slug.unique' => 'Slug đã tồn tại, vui lòng chọn slug khác.',

            'description.string' => 'Mô tả phải là chuỗi ký tự.',

            'author_id.exists' => 'Tác giả không tồn tại.',

            'genre_ids.array' => 'Thể loại phải là mảng.',
            'genre_ids.*.exists' => 'Thể loại không tồn tại.',

            'avatar.image' => 'Avatar phải là file ảnh.',
            'avatar.mimes' => 'Avatar phải có định dạng jpeg, png, jpg, gif.',
            'avatar.max' => 'Avatar không được vượt quá 2MB.',

            'cover.image' => 'Cover phải là file ảnh.',
            'cover.mimes' => 'Cover phải có định dạng jpeg, png, jpg, gif.',
            'cover.max' => 'Cover không được vượt quá 5MB.',

            'status.required' => 'Trạng thái là bắt buộc.',
            'status.in' => 'Trạng thái không hợp lệ.',
        ];
    }

    public function attributes(): array
    {
        return [
            'title' => 'tiêu đề truyện',
            'slug' => 'slug',
            'description' => 'mô tả',
            'author_id' => 'tác giả',
            'genre_ids' => 'thể loại',
            'avatar' => 'avatar',
            'cover' => 'cover',
            'status' => 'trạng thái',
        ];
    }
}