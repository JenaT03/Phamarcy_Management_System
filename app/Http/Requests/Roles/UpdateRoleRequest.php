<?php

namespace App\Http\Requests\Roles;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRoleRequest extends FormRequest
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
            'display_name' => ['required', 'max:255'],
            'group' => 'required',
            'permission_ids' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.max' => 'Tên không được vượt quá 255 ký tự',
            'name.required' => 'Tên không được để trống',
            'display_name.required' => 'Tên hiển thị không được để trống',
            'display_name.max' => 'Tên không được vượt quá 255 ký tự',
            'group.required' => 'Vui lòng chọn nhóm',
            'permission_ids.required' => 'Vui lòng chọn quyền hạn',
        ];
    }
}
