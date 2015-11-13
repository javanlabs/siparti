<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateProgramKerjaUsulanRequest extends Request
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
            'namaProgram' => 'required',
            'instansiTerkait' => 'required',
            'description' => 'required',
            'file' => 'required|mimes:pdf'
        ];
    }
}
