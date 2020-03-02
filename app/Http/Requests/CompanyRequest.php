<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class CompanyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() : bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function rules(Request $request) : array
    {
        return [
            "name" => 'required|string|max:100|unique:company,name,'.$request->route('id'),
            "address" => 'nullable|string|max:100',
            "email" => 'nullable|string|email|max:100|unique:company,email,'.$request->route('id'),
            "contact" => 'nullable|string|max:45',
            "logo" => 'nullable|string|url'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages() : array
    {
        return [
            'logo.url'  => 'Logo must be a valid URL.',
        ];
    }
}
