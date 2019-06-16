<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class SettingsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules =  [
            'email'=>'required',
        ];

        if ((Request::input('nip') !== null)) {
            $rules['nip'] = 'digits:10';
        }

        if (Request::input('new_password')!== null) {
            $rules['new_password'] = 'min:6|required_with:confirm_password|same:confirm_password';
            $rules['confirm_password'] = 'min:6';
        }

        return $rules;
    }
}
