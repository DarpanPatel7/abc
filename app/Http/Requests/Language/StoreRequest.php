<?php

namespace App\Http\Requests\Language;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
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
            'language_name' => ['required', 'max:255', 'not_regex:/<\/?[^>]*>/'],
            'language_shortcode' => ['required', 'max:255', 'alpha', 'unique:languages,shortcode' ,'not_regex:/<\/?[^>]*>/'],
        ];
    }
}
