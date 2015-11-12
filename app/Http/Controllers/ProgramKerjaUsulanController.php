<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ProgramKerjaUsulanController extends Controller
{
    public function tambah(Requests $request)
    {
    	if ($request::isMethod('POST')) {

    		$this->validate($request)
    	}
    }
}
