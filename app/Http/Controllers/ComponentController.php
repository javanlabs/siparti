<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use App\Http\Requests;

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
        $comments = $model->comments;

        return view('components/mural', compact('model', 'comments'));
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
}
