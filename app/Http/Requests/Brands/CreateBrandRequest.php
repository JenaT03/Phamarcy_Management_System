<?php

namespace App\Http\Requests\Brands;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class CreateBrandRequest extends FormRequest
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
            'name' => ['required', 'max:255'],
            'country' => 'required',
            'img' => ['required', 'image', 'mimes:png,jpg,PNG,jpeg', 'max:2048'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên không được để trống',
            'name.max' => 'Tên không được vượt quá 255 ký tự',
            'country.required' => 'Tên quốc gia không được để trống',
            'img.image' => 'Hình ảnh không hợp lệ',
            'img.mimes' => 'Hình ảnh phải thuộc một trong các định dạng png, jpg, PNG hoặc jpeg',
            'img.max' => 'Hình ảnh phải nhỏ hơn 2MB',
            'img.required' => 'Hình ảnh không được để trống',

        ];
    }
}
