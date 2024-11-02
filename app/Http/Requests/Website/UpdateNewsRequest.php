<?php

namespace App\Http\Requests\Website;

use Illuminate\Foundation\Http\FormRequest;

class UpdateNewsRequest extends FormRequest
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
            'img' => ['image', 'mimes:png,jpg,PNG,jpeg', 'max:2048'],
            'title' => ['required', 'max:255'],
            'abstract' => 'required',
            'content' => 'required',
            'author' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'img.image' => 'Hình ảnh không hợp lệ',
            'img.mimes' => 'Hình ảnh phải thuộc một trong các định dạng png, jpg, PNG hoặc jpeg',
            'img.max' => 'Hình ảnh phải nhỏ hơn 2MB',
            'title.required' => 'Tiêu đề không được để trống',
            'title.max' => 'Tiêu đề phải ít hơn 255 ký tự',
            'abstract.required' => 'Mở đầu không được để trống',
            'content.required' => 'Nội dung không được để trống',
            'author.required' => 'Tên tác giả không được để trống',
        ];
    }
}
