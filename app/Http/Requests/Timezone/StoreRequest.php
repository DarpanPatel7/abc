<?php

namespace App\Http\Requests\Timezone;

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
            'timezone_name' => ['required', 'max:255', 'not_regex:/<\/?[^>]*>/'],
            'timezone_utc_offset' => ['required', 'max:255', 'regex:/^-?\d+(\:\d{1,9})?$/', 'not_regex:/<\/?[^>]*>/'],
        ];
    }
}
