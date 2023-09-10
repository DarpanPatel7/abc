<?php

namespace App\Http\Requests\Role;

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
            'role_name' => ['required', 'unique:roles,name' ,'not_regex:/<\/?[^>]*>/', 'max:50'],
            'permission' => ['required'],
        ];
    }

    /**
     * @return array|string[]
     */
    public function messages(): array
    {
        return [
            'role_name.required' => 'The role name is required.',
            'role_name.unique' => 'The role name has already been taken.',
            'role_name.max' => 'The role name must not be greater than 50 characters.',
            'role_name.not_regex' => 'The role name format is invalid.',
            'permission.required' => 'At least one Permission has to be selected.'
        ];
    }
}
