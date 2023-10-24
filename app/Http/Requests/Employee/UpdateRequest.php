<?php

namespace App\Http\Requests\Employee;

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
    public function rules() :array
    {
        $id = Crypt::decrypt($this->employee);

        return [
            'employee_no' => ['required', 'max:255', 'unique:users,employee_no,' . $id ,'not_regex:/<\/?[^>]*>/'],
            'name' => ['required', 'max:255' ,'not_regex:/<\/?[^>]*>/'],
            'current_address' => ['required','not_regex:/<\/?[^>]*>/'],
            'permanent_address' => ['required','not_regex:/<\/?[^>]*>/'],
            'date_of_birth' => ['required', 'before:today', 'date_format:'.Config('global.date_format')],
            'joining_date' => ['required', 'date_format:'.Config('global.date_format')],
            'profile_photo' => ['nullable'],
            'identity_proof' => ['nullable', 'mimes:jpg,jpeg,png,svg,pdf', 'max:2048'],
            'designation' => ['required', 'exists:designations,id'],
        ];
    }
}
