<?php

namespace App\Http\Requests\Products;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'name' => ['required', 'unique:products,name,' . $this->route('product'), 'max:255'],
            'description' => 'required',
            'ingredient' => 'required',
            'img' => ['image', 'mimes:png,jpg,PNG,jpeg', 'max:2048'],
            'brand_id' => 'required|exists:brands,id',
            'category_ids' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên không được để trống',
            'name.max' => 'Tên không được vượt quá 255 ký tự',
            'name.unique' => 'Tên sản phẩm đã tồn tại',
            'description.required' => 'Mô tả không được để trống',
            'ingredient.required' => 'Thành phần không được để trống',
            'img.image' => 'Hình ảnh không hợp lệ',
            'img.mimes' => 'Hình ảnh phải thuộc một trong các định dạng png, jpg, PNG hoặc jpeg',
            'img.max' => 'Hình ảnh phải nhỏ hơn 2MB',
            'brand_id.required' => 'Vui lòng chọn nhãn hàng',
            'brand_id.exsit' => 'Vui lòng chọn nhãn hàng',
            'category_ids.required' => 'Vui lòng phân loại sản phẩm',


        ];
    }
}
