<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use asset;

class ImageController extends Controller
{
    public function upload(Request $request)
    {
        
        $data = $request->file('file');
        
        $name = $data->getClientOriginalName();
        
        $extension = $data->getClientOriginalExtension();
        
        $data->move(base_path() . '/public/gambar', $name . "." . $extension);
        
        $imageFullPath = asset('gambar/' . $name . "." . $extension);
        
        $feedBack = [ 'filelink' => $imageFullPath ];
        
        return stripslashes(json_encode($feedBack));
    }
}
