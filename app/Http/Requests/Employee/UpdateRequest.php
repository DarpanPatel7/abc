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
            'profile_photo' => ['nullable'],
            'employee_no' => ['required', 'max:255', 'unique:users,employee_no,' . $id, 'not_regex:/<\/?[^>]*>/'],
            'name' => ['required', 'max:255', 'not_regex:/<\/?[^>]*>/'],
            'email' => ['required', 'email', 'unique:users,email,' . $id, 'max:255', 'not_regex:/<\/?[^>]*>/'],
            'phone_number' => ['required', 'numeric', 'min:11', 'not_regex:/<\/?[^>]*>/'],
            'date_of_birth' => ['required', 'before:today', 'date_format:'.Config('global.date_format')],
            'joining_date' => ['required', 'date_format:'.Config('global.date_format')],
            'country' => ['required', 'exists:countries,id'],
            'state' => ['required', 'exists:states,id'],
            'address' => ['required','not_regex:/<\/?[^>]*>/'],
            'zipcode' => ['required', 'numeric', 'digits:6', 'not_regex:/<\/?[^>]*>/'],
            'language' => ['required', 'exists:languages,id'],
            'timezone' => ['required', 'exists:timezones,id'],
            'currency' => ['required', 'exists:currencies,id'],
            'designation' => ['required', 'exists:designations,id'],
            'organization' => ['required', 'max:255', 'not_regex:/<\/?[^>]*>/'],
            'identity_proof' => ['nullable', 'mimes:jpg,jpeg,png,svg,pdf', 'max:2048'],
        ];
    }
}
