<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAcademicYearRequest extends FormRequest
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
            'academic_start_year' => ['required'],
            'academic_end_year' => ['required'],
            'academic_name' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'academic_start_year.required' => 'Bạn chưa chọn Năm bắt đầu',
            'academic_end_year.required' => 'Bạn chưa chọn Năm kết thúc',
            'academic_name.required' => 'Tên Niên khoá không được để trống',

        ];
    }
}
