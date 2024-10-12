<?php

namespace App\Http\Requests\ReceiptDetails;

use Illuminate\Foundation\Http\FormRequest;

class CreateReceiptDetailRequest extends FormRequest
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

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $expiryDate = $this->input('expiry');
            $minDate = now()->addMonths(6)->toDateString();

            if ($expiryDate < $minDate) {
                $validator->messages()->add('expiry', 'Ngày hết hạn phải hơn 6 tháng.');
            }
        });
    }
    public function rules()
    {
        return [
            'product_code' => 'required|exists:products,code',
            'quantity' => 'min:1|numeric',
            'original_price' => 'min:0|numeric',
            'selling_price' => 'min:0|numeric',
            'expiry' => 'date'


        ];
    }

    public function messages()
    {
        return [
            'product_code.exists' => 'Mã số sản phẩm không tồn tại',
            'product_code.required' => 'Mã sản phẩm không được để trống',
            'quantity.min' => 'Số lượng không được nhỏ hơn 1',
            'quantity.numeric' => 'Số lượng phải là số',
            'original_price.min' => 'Giá tiền không hợp lệ',
            'original_price.numeric' => 'Giá tiền phải là số',
            'selling_price.min' => 'Giá tiền không hợp lệ',
            'selling_price.numeric' => 'Giá tiền phải là số',
            'expiry.date' => 'Ngày không hợp lệ',
        ];
    }
}
