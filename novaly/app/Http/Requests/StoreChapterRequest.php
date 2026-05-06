<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreChapterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'access_type' => 'required|in:free,coin,premium',
            'coin_price' => 'required_if:access_type,coin|nullable|numeric|min:0',
            'money_price' => 'required_if:access_type,premium|nullable|numeric|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Tiêu đề chương là bắt buộc.',
            'title.string' => 'Tiêu đề chương phải là chuỗi ký tự.',
            'title.max' => 'Tiêu đề chương không được vượt quá 255 ký tự.',

            'access_type.required' => 'Loại truy cập là bắt buộc.',
            'access_type.in' => 'Loại truy cập không hợp lệ.',

            'coin_price.required_if' => 'Giá coin là bắt buộc khi chọn truy cập coin.',
            'coin_price.numeric' => 'Giá coin phải là số.',
            'coin_price.min' => 'Giá coin phải lớn hơn hoặc bằng 0.',

            'money_price.required_if' => 'Giá tiền là bắt buộc khi chọn truy cập premium.',
            'money_price.numeric' => 'Giá tiền phải là số.',
            'money_price.min' => 'Giá tiền phải lớn hơn hoặc bằng 0.',
        ];
    }

    public function attributes(): array
    {
        return [
            'title' => 'tiêu đề chương',
            'access_type' => 'loại truy cập',
            'coin_price' => 'giá coin',
            'money_price' => 'giá tiền',
        ];
    }
}
