<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AgencyRequest extends FormRequest
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
            'name' => 'required',
            'address' => 'required',
            'fImage' => 'required|image',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name not null',
            'address.request' => 'Address not null',
            'fImage.required' => 'Image not null',
            'fImage.image' => 'Please choose Image',
        ];
    }
}
