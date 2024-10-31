<?php

namespace App\Http\Requests\Categories;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
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
            'name' => ['required', 'unique:categories,name,' . $this->route('category'), 'max:255'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên loại sản phẩm không được bỏ trống.',
            'name.max' => 'Tên không được vượt quá 255 ký tự',
            'name.unique' => 'Tên loại sản phẩm đã tồn tại.',
        ];
    }
}
