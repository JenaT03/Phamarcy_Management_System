<?php

namespace App\Http\Requests\Staffs;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStaffRequest extends FormRequest
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
            'name' => 'required',
            'gender' => 'required',
            'birth' => ['required', 'regex:/^[0-9]{4}$/'],
            'phone' => ['required', 'unique:staffs,phone,' . $this->route('staff'), 'regex:/^(09|03|07|08|05)+([0-9]{8})$/'],
            'address' => ['required', 'max:100'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên không được để trống.',
            'gender.required' => 'Giới tính không được để trống.',
            'phone.required' => 'Số điện thoại không được để trống.',
            'birth.required' => 'Năm sinh không được để trống',
            'birth.regex' => 'Năm sinh không hợp lệ',
            'phone.unique' => 'Số điện thoại này đã tồn tại.',
            'phone.regex' => 'Số điện thoại không hợp lệ.',
            'address.required' => 'Địa chỉ không được để trống',
            'address.max' => 'Địa chỉ tối đa 100 ký tự',
        ];
    }
}
