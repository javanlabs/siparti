<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class StoreFaseRequest extends Request
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
            'proker_id' => 'required',
            'type'      => 'required',
            'satker_id' => 'required',
            'scope'        => 'required',     
            'target'       => 'required', 
            'progress'     => 'required', 
            'kendala'      => 'required',
            'instansi_terkait'  => 'required',
            'start_date'        => 'required',
            'end_date'          => 'required',    
            'description'       => 'required',
            'pagu'              => 'required',
            'pic'               => 'required'    
            
                
        ];
    }
}
