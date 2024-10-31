<?php

namespace App\Http\Requests\Brands;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBrandRequest extends FormRequest
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
            'country' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.max' => 'Tên không được vượt quá 255 ký tự',
            'country.required' => 'Tên quốc gia không được để trống',
        ];
    }
}
