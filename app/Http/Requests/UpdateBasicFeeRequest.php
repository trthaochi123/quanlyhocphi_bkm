<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBasicFeeRequest extends FormRequest
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
            'basic_fee_amount' => ['required', 'regex:/^[1-9]+[0-9.]*$/', 'min:1'],
        ];
    }

    public function messages()
    {
        return [
            'basic_fee_amount.required' => 'Mức học phí không thể để trống',
            'basic_fee_amount.regex' => 'Mức học phí phải lớn hơn 0',
        ];
    }
}
