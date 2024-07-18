<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSendSMSRequest extends FormRequest
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
            'number' =>  ['required', 'regex:/^\+[0-9]+[0-9.]*$/'],
            'message' => ['required']
        ];
    }

    public function messages()
    {
        return [
            'number.required' => 'Bạn cần nhập Số điện thoại của phụ huynh',
            'number.regex' => 'SĐT không hợp lệ',
            'message.required' => 'Bạn cần nhập nội dung thông báo'
        ];
    }
}
