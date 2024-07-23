<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
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
            'student_name' => ['required'],
            'student_dob' => ['required'],
            'student_phone' => ['required', 'regex:/^[0-9]+[0-9.]*$/'],
            'province' => ['required'],
            'district' => ['required'],
            'street' => ['required'],
            'student_parent_phone' => ['required', 'regex:/^\+[0-9]+[0-9.]*$/'],
            
        ];
    }

    public function messages()
    {
        return [
            'student_name.required' => 'Tên sinh viên không thể để trống',
            'student_dob.required' => 'Bạn chưa chọn ngày sinh của sinh viên',
            'student_phone.required' => 'SĐT không thể để trống',
            'student_phone.regex' => 'SĐT không hợp lệ',
            'province.required' => 'Trường thành phố không thể để trống',
            'district.required' => 'Trường quận không thể để trống',
            'street.required' => 'Trường đường không thể để trống',
            'student_parent_phone.required' => 'không thể để trống',
            'student_parent_phone.regex' => 'SĐT phụ huynh không hợp lệ',
            
        ];
    }

}
