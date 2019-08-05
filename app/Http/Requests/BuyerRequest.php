<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BuyerRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email|unique:users',
            'name' => 'required',
            'phone' => 'required|max:16|digits_between:9,15',
            'password' => 'required',
            'address' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'email not null',
            'email.email' => 'email invalid',
            'email.unique' => 'email is already exist',
            'name.required' => 'name must be not null',
            'phone.required' => 'phone must be not null',
            'phone.max' => 'phone must be large 8 character',
            'phone.digits_between' => 'phone must be number',
            'password.required' => 'password must be not null',
            'address.required' => 'address must be not null' 
        ];
    }
}
