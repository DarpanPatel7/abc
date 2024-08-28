<?php

namespace App\Http\Requests\AdminMenu;

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
    public function rules()
    {
        $id = Crypt::decrypt($this->admin_menu);

        return [
            'menu_name' => ['required', 'max:255', 'not_regex:/<\/?[^>]*>/'],
            'menu_url' => ['required', 'max:255', 'unique:admin_menus,menu_url,' . $id, 'regex:/^(\/[A-Za-z0-9\/]*)|(#)$/'],
            'menu_type' => ['required', 'numeric'],
        ];
    }
}
