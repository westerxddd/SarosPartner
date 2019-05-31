<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DealRequest extends FormRequest
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
        return [
            'name' => 'required',
            'extra' => 'required',
            'image' => 'image|max:5120'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tytuł jest polem wymaganym!',
            'extra.required' => 'Prefiks jest polem wymaganym',
        ];
    }
}
