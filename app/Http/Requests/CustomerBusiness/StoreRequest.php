<?php

namespace App\Http\Requests\CustomerBusiness;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() :bool
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
            'customer_business_name' => ['required', 'max:255', 'unique:customer_businesses,name' ,'not_regex:/<\/?[^>]*>/'],
        ];
    }
}
