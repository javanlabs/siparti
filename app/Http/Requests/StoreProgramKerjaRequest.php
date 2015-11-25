<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class StoreProgramKerjaRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'              => 'required|string',
            'satuanKerjaBaru'   => 'required_without_all:satker_id|string',
            'satker_id'         => 'required_without_all:satuanKerjaBaru',
            'satkerChoice'      => 'required'
        ];
    }
}
