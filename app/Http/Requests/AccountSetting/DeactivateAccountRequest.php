<?php

namespace App\Http\Requests\AccountSetting;

use Illuminate\Foundation\Http\FormRequest;

class DeactivateAccountRequest extends FormRequest
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
            'accountDeactivation' => 'required'
        ];
    }

    /**
     * @return array|string[]
     */
    public function messages(): array
    {
        return [
            'accountDeactivation.required' => 'Please confirm your acceptance of the account deactivation.',
        ];
    }
}
