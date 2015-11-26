<?php

namespace App\Http\Controllers\Admin;

use Efriandika\LaravelSettings\Facades\Settings;
use Illuminate\Http\Request;

use App\Http\Requests;

class SettingController extends AdminController
{
    /**
     * SettingController constructor.
     */
    public function __construct()
    {
        $this->authorize('manage-settings');
    }


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('admin.settings.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        foreach($request->except('_token') as $key => $value) {
            Settings::set('app.' . $key, $value);
        }

        return redirect()->back();
    }

}
