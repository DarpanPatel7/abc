<?php

namespace App\Http\Requests\Employee;

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
        return [
            'employee_no' => ['required', 'max:255', 'unique:designations,name' ,'not_regex:/<\/?[^>]*>/'],
            'name' => ['required', 'max:255', 'unique:designations,name' ,'not_regex:/<\/?[^>]*>/'],
            'current_address' => ['required'],
            'permanent_address' => ['required'],
            'date_of_birth' => ['required'],
            'joining_date' => ['required'],
            'profile_photo' => ['required'],
            'identiy_proof' => ['required'],
            'designation' => ['required'],
        ];
    }
}
