<?php

namespace App\Http\Requests\ReleaseDetails;

use Illuminate\Foundation\Http\FormRequest;

class UpdateReleaseDetailRequest extends FormRequest
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
            'product_code' => 'required|exists:products,code',
            'quantity' => 'min:1|numeric',
            'price' => 'min:0|numeric',
        ];
    }

    public function messages()
    {
        return [
            'product_code.required' => 'Mã sản phẩm không được để trống',
            'product_code.exists' => 'Mã số sản phẩm không tồn tại',
            'quantity.min' => 'Số lượng không được nhỏ hơn 1',
            'quantity.numeric' => 'Số lượng phải là số',
            'price.min' => 'Giá tiền không hợp lệ',
            'price.numeric' => 'Giá tiền phải là số',
        ];
    }
}
