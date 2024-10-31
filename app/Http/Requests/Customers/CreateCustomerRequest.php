<?php

namespace App\Http\Requests\Customers;

use Illuminate\Foundation\Http\FormRequest;

class CreateCustomerRequest extends FormRequest
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
            'birth' => ['required', 'regex:/^[0-9]{4}$/'],
            'gender' => 'required',
            'phone' => ['required', 'unique:customers,phone', 'regex:/^(09|03|07|08|05)+([0-9]{8})$/'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên không được để trống.',
            'name.max' => 'Tên không được vượt quá 255 ký tự',
            'gender.required' => 'Giới tính không được để trống.',
            'phone.required' => 'Số điện thoại không được để trống.',
            'birth.required' => 'Năm sinh không được để trống',
            'birth.regex' => 'Năm sinh không hợp lệ',
            'phone.unique' => 'Số điện thoại này đã tồn tại.',
            'phone.regex' => 'Số điện thoại không hợp lệ.',
        ];
    }
}
