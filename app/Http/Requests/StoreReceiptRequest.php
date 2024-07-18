<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReceiptRequest extends FormRequest
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
            'submitter_name' => ['required'],
            'submitter_phone' => ['required', 'regex:/^[0-9]+[0-9.]*$/'],
            'payment_date_time' => ['required'],
            'amount_of_money' => ['required', 'regex:/^[1-9]+[0-9.]*$/'],
            'note' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'submitter_name.required' => 'Tên người nộp không thể để trống',
            'submitter_phone.required' => 'SĐT người nộp không thể để trống',
            'submitter_phone.regex' => 'SĐT người nộp không hợp lệ',
            'payment_date_time.required' => 'Bạn chưa chọn ngày nộp',
            'amount_of_money.required' => 'Bạn chưa nhập số tiền nộp ',
            'amount_of_money.regex' => 'Số tiền nộp không hợp lệ',
            'note.required' => 'Nội dung phiếu thu không thể để trống'
        ];
    }
}
