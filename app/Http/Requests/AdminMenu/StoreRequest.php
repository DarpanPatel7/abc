<?php

namespace App\Http\Requests\AdminMenu;

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
            'menu_name' => ['required', 'max:255', 'not_regex:/<\/?[^>]*>/'],
            'menu_url' => ['required', 'max:255', 'unique:admin_menus,menu_url', 'regex:/^(\/[A-Za-z0-9\/]*)|(#)$/'],
            'menu_type' => ['required', 'numeric'],
        ];
    }
}
