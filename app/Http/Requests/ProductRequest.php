<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'base_price' => 'required|digits_between:2,8',
            'cate.*' => 'required',
            'agency.*' => 'required',
            'fImage.*' => 'required|image',
            'quantity.*' => 'required|digits_between:1,5',
            'discount_rate.*' => 'required|digits_between:1,5',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name must not be null or empty',
            'base_price.required' => 'base price must not be null or empty',
            'base_price.digits_between' => 'base price must number',
            'cate.*.required' => 'category must not be null or empty',
            'agency.*.required' => 'agency must not be null or empty',
            'fImage.*.required' => 'image must not be null or empty',
            'fImage.*.image' => 'Please choose picture',
            'quantity.*.required' => 'Quantity must not be null or empty',
            'quantity.*.digits_between' => 'Quantity must is number',
            'discount_rate.*.required' => 'discount rate must not be null or empty',
            'discount_rate.*.digits_between' => 'discount rate must is number',
        ];
    }
}
