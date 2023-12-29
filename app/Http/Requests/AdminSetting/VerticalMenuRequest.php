<?php

namespace App\Http\Requests\AdminSetting;

use Illuminate\Foundation\Http\FormRequest;

class VerticalMenuRequest extends FormRequest
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
            'vertical_value' => ['required', 'json'],
        ];
    }

    /**
     * @return array|string[]
     */
    public function messages(): array
    {
        return [
            'vertical_value.required' => 'The vertical menu json field is required.',
            'vertical_value.json' => 'The vertical menu json must be a valid JSON string.',
        ];
    }
}
