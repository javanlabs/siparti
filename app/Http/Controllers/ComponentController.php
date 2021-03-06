<?php

namespace App\Http\Controllers;

use App\Entities\User;
use App\Entities\Post;
use Illuminate\Http\Request;

class ComponentController extends Controller
{
    /**
     * ComponentController constructor.
     */
    public function __construct()
    {

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
    public function getStar()
    {
        $model = Post::firstOrFail();

        return view('components/star', compact('model'));
    }

    /**
     * @return \Illuminate\View\View
     */
    public function getVotee()
    {
        $model = Post::firstOrFail();
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

    public function getForm()
    {
        return view('components/form');
    }

    public function postForm(Request $request)
    {
        $rules = ['username' => 'required|min:4'];
        $this->validate($request, $rules);
    }
}
