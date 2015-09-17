<?php

namespace App\Http\Requests\User;

use App\Http\Requests\Request;

class AdminEditProfile extends Request
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
            'name'   => 'required|max:255',
            'email'  => 'required|email|unique:users,id,' . auth()->user()->getAuthIdentifier(),
            'status' => 'required'
        ];
    }
}
