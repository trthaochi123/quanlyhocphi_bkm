<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAdminRequest extends FormRequest
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
            'admin_name' => ['required'],
            'admin_phone' => ['required', 'regex:/^[0-9]+[0-9.]*$/'],
            'province' => ['required'],
            'district' => ['required'],
            'street' => ['required'],
            'email' => ['required'],
            'password' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'admin_name.required' => 'Tên Quản toán viên không thể để trống',
            'admin_phone.required' => 'Số điện thoại không thể để trống',
            'admin_phone.regex' => 'Số điện thoại không hợp lệ',
            'province.required' => 'Trường thành phố không thể để trống',
            'district.required' => 'Trường quận không thể để trống',
            'street.required' => 'Trường đường không thể để trống',
            'email.required' => 'Trường email không thể để trống',
            'password.required' => 'Mật khẩu không thể để trống',
        ];
    }
}
