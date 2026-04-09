<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGenreRequest extends FormRequest
{
    /**
     * Kiểm tra xem user có quyền cập nhật genre không
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Luật validate cho việc cập nhật genre
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', 'unique:genres,name,' . $this->genre->id],
            'slug' => ['nullable', 'string', 'max:255', 'unique:genres,slug,' . $this->genre->id],
        ];
    }

    /**
     * Thông báo lỗi bằng tiếng Việt
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Tên thể loại không được để trống',
            'name.string' => 'Tên thể loại phải là chuỗi ký tự',
            'name.max' => 'Tên thể loại không được vượt quá 255 ký tự',
            'name.unique' => 'Tên thể loại đã tồn tại',
            'slug.string' => 'Slug phải là chuỗi ký tự',
            'slug.max' => 'Slug không được vượt quá 255 ký tự',
            'slug.unique' => 'Slug đã tồn tại',
        ];
    }
}
