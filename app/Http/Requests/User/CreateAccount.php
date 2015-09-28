<?php

namespace App\Http\Requests\User;

use App\Http\Requests\Request;

class CreateAccount extends Request
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
            'name'     => 'required|max:255',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:6|max:255',
            'status'   => 'required'
        ];
    }
}
