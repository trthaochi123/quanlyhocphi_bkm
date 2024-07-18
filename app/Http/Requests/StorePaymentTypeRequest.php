<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePaymentTypeRequest extends FormRequest
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
            'payment_type_name' => ['required'],
            'discount' => ['required', 'regex:/^[0-9]+[0-9.]*$/'],
            'payment_times' => ['required', 'regex:/^[0-9]+[0-9.]*$/', 'min:1']
        ];
    }

    public function messages()
    {
        return [
            'payment_type_name.required' => 'Tên kiểu đóng không thể để trống',
            'discount.required' => 'Mức giảm học phí không thể để trống',
            'discount.regex' => 'Mức giảm học phí không hợp lệ',
            'payment_times.required' => 'Tổng số lần đóng không thể để trống',
            'payment_times.regex' => 'Tổng số lần đóng không hợp lệ',
        ];
    }
}
