<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class EmployeeRequest extends FormRequest
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
            "department_id" => 'required|integer',
            "fname" => 'required|string|max:45',
            "mname" => 'nullable|string|max:45',
            "lname" => 'required|string|max:45',
            "position" => 'string|max:45',
            "status" => 'integer'
        ];
    }
}
