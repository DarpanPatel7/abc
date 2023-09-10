<?php

namespace App\Http\Requests\Designation;

use Illuminate\Support\Facades\Crypt;
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
        $id = Crypt::decrypt($this->designation);
            
        $validator = Validator::make(['id' => $id], [
            'id' => 'required|exists:designations,id'
        ]);
        
        if ($validator->fails()) {
            return Response::json(['error' => $validator->errors()->first()], 202);
        }

        return [
            // 'id' => 'required|exists:designations,id',
            'designation_name' => ['required', 'max:255', 'not_regex:/<\/?[^>]*>/', 'unique:designations,name,' . $id],
        ];
    }
}
