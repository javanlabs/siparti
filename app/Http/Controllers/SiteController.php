<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class SiteController extends Controller
{
    public function getKontak()
    {
        return view('site.kontak');
    }

    public function getTentang()
    {
        return view('site.tentang');
    }

}
