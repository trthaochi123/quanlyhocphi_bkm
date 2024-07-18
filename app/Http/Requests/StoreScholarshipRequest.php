<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreScholarshipRequest extends FormRequest
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
            'scholarship_amount' => ['required', 'regex:/^[1-9]+[0-9.]*$/','min:1'],
        ];
    }

    public function messages()
    {
        return [
            'scholarship_amount.required' => 'Bạn chưa nhập mức học bổng',
            'scholarship_amount.regex' => 'Mức học bổng phải là số và lớn hơn 0',
        ];
    }
}
