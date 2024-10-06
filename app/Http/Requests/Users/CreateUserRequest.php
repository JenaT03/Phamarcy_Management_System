<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
            'phone' => ['required', 'unique:users,phone', 'regex:/^(09|03|07|08|05)+([0-9]{8})$/'],
            'password' => ['required', 'min:8', 'confirmed'],
            'role_ids' => 'required|array|min:1'
        ];
    }

    public function messages()
    {
        return [
            'phone.required' => 'Số điện thoại không được để trống.',
            'phone.unique' => 'Số điện thoại này đã tồn tại.',
            'phone.regex' => 'Số điện thoại không hợp lệ.',
            'password.required' => 'Mật khẩu không được để trống',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự',
            'password.confirmed' => 'Nhập lại mật khẩu không khớp.',
            'role_ids.required' => 'Bạn phải chọn ít nhất một vai trò.',
            'role_ids.min' => 'Bạn phải chọn ít nhất một vai trò.',
        ];
    }
}
