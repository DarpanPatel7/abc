<?php

namespace App\Http\Requests\Currency;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
        $id = Crypt::decrypt($this->currency);

        return [
            'currency_name' => ['required', 'max:255', 'not_regex:/<\/?[^>]*>/'],
            'currency_code' => ['required', 'max:255', 'alpha', 'not_regex:/<\/?[^>]*>/', 'unique:currencies,code,' . $id],
            'currency_rate' => ['required', 'max:255', 'numeric', 'regex:/^-?\d+(\.\d{1,9})?$/', 'not_regex:/<\/?[^>]*>/'],
        ];
    }
}
