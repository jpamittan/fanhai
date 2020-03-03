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
            "to" => 'required|string',
            "title" => 'nullable|string|max:50',
            "msg" => 'required|string',
            "type" => 'required|string'
        ];
    }
}
