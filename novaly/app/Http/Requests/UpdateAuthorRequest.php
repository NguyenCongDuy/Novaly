<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAuthorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'date' => 'nullable|date',
            'address' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'bio' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Tên tác giả là bắt buộc.',
            'name.string' => 'Tên tác giả phải là chuỗi ký tự.',
            'name.max' => 'Tên tác giả không được vượt quá 255 ký tự.',

            'date.date' => 'Ngày sinh không đúng định dạng.',

            'address.string' => 'Địa chỉ phải là chuỗi ký tự.',
            'address.max' => 'Địa chỉ không được vượt quá 255 ký tự.',

            'description.string' => 'Mô tả phải là chuỗi ký tự.',
            'bio.string' => 'Tiểu sử phải là chuỗi ký tự.',
        ];
    }
}
