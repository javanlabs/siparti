<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UpdateProgramKerjaUsulanRequest extends Request
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
            'name'  => 'required|string',
            'description'   => 'required',
            'instansi_stakeholder' => 'required',
            'manfaat' => 'required',
            'lokasi' => 'required',
            'target' => 'required',
            
        ];
    }
}
