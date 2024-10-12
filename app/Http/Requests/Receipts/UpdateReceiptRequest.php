<?php

namespace App\Http\Requests\Receipts;

use Illuminate\Foundation\Http\FormRequest;

class UpdateReceiptRequest extends FormRequest
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
            'supplier_id' => 'required|exists:suppliers,id',
        ];
    }

    public function messages()
    {
        return [
            'supplier_id.required' => 'Vui lòng chọn nhà cung cấp',
            'supplier_id.exsit' => 'Vui lòng chọn nhà cung cấp',
        ];
    }
}
