<?php

namespace App\Http\Requests\Statistics;

use Illuminate\Foundation\Http\FormRequest;

class StatisticRequest extends FormRequest
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
            'date-start' => 'required|date',
            'date-end' => 'required|date|after_or_equal:date-start',
        ];
    }

    public function messages()
    {
        return [
            'date-start.required' => 'Vui lòng nhập ngày bắt đầu',
            'date-start.date' => 'Vui lòng nhập ngày hợp lệ',
            'date-end.required' => 'Vui lòng nhập ngày kết thúc',
            'date-end.date' => 'Vui lòng nhập ngày hợp lệ',
            'date-end.after_or_equal' => 'Ngày kết thúc phải lớn hơn hoặc bằng ngày bắt đầu',

        ];
    }
}
