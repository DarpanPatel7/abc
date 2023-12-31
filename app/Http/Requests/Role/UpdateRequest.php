<?php

namespace App\Http\Requests\Role;

use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
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
        $id = Crypt::decrypt($this->role);

        return [
            'role_name' => ['required', 'unique:roles,name,'.$id ,'not_regex:/<\/?[^>]*>/', 'max:50'],
            'permission' => ['required'],
        ];
    }

    /**
     * @return array|string[]
     */
    public function messages(): array
    {
        return [
            'name.required' => 'The role Name is required.',
            'name.unique' => 'The role name has already been taken.',
            'name.max' => 'The role name must not be greater than 50 characters.',
            'name.not_regex' => 'The role name format is invalid.',
            'permission.required' => 'At least one Permission has to be selected.'
        ];
    }
}
