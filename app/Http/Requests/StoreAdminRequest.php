<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAdminRequest extends FormRequest
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
            'password' => ['required', 'regex:/^[0-9]+[0-9.]*$/', 'min:1'],
        ];
    }


    public function messages()
    {
        return [
            'admin_name.required' => 'Admin name cannot be blank',
            'admin_phone.required' => 'Phone number cannot be blank',
            'admin_phone.regex' => 'Phone number must be valid',
            'province.required' => 'Province field cannot be blank',
            'district.required' => 'District field cannot be blank',
            'street.required' => 'Street field cannot be blank',
            'email.required' => 'Email field cannot be blank',
            'password.required' => 'Password field cannot be blank',
            'password.regex' => 'Password must be valid',
            'password.min' => 'Password value must be larger than 0',
        ];
    }
}
