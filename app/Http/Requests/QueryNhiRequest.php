<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class QueryNhiRequest extends Request
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
            'nhi_and_ward' => array('required','regex:/^(q|r)\w{3}\d{4}[\,]{1}.{1,}$/')
        ];
    }

    public function messages()
    {
        return [
            'nhi_and_ward.regex' => 'Please type either q or r and scan barcode of chart.',
            'nhi_and_ward.required' => 'Please enter a valid NHI.',
    ];
    }
}