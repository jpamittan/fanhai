<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class PhonebookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *s
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
            "employee_id" => 'required|integer|unique:phonebook,employee_id,'.$request->route('id'),
            "address" => 'nullable|string|max:100',
            "work_email" => 'nullable|string|max:50|unique:phonebook,work_email,'.$request->route('id'),
            "email" => 'nullable|string|email|max:50|unique:phonebook,email,'.$request->route('id'),
            "home_phone" => 'nullable|string|max:15',
            "work_phone" => 'nullable|string|max:13|unique:phonebook,work_phone,'.$request->route('id'),
            "mobile_phone" => 'nullable|string|max:13|unique:phonebook,mobile_phone,'.$request->route('id'),
        ];
    }
}
