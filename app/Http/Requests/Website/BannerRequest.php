<?php

namespace App\Http\Requests\Website;

use Illuminate\Foundation\Http\FormRequest;

class BannerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'img' => ['required', 'image', 'mimes:png,jpg,PNG,jpeg'],
        ];
    }

    public function messages()
    {
        return [
            'img.required' => 'Hình ảnh không được để trống',
            'img.image' => 'Hình ảnh không hợp lệ',
            'img.mimes' => 'Hình ảnh phải thuộc một trong các định dạng png, jpg, PNG hoặc jpeg',
        ];
    }
}
