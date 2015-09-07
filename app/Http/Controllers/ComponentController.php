<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ComponentController extends Controller
{
    /**
     * ComponentController constructor.
     */
    public function __construct()
    {
        auth()->loginUsingId(1);
    }


    /**
     * @return \Illuminate\View\View
     */
    public function getMural()
    {
        $model = Post::firstOrFail();
        return view('components/mural', compact('model'));
    }

    /**
     * @return \Illuminate\View\View
     */
    public function getVotee()
    {
        $model = User::firstOrFail();
        return view('components/votee', compact('model'));
    }

    /**
     * @return \Illuminate\View\View
     */
    public function getSenarai()
    {
        $model = User::firstOrFail();
        return view('components/senarai', compact('model'));
    }

    /**
     * @return \Illuminate\View\View
     */
    public function getMultilog()
    {
        $model = User::firstOrFail();
        return view('components/multilog', compact('model'));
    }
}
