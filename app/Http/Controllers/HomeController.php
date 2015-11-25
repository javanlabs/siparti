<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Repositories\FaseRepositoryEloquent;

class HomeController extends Controller
{
    /**
     * @var FaseRepositoryEloquent
     */
    protected $repository;


    /**
     * HomeController constructor.
     */
    public function __construct(FaseRepositoryEloquent $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $terbaru = $this->repository->all();
        $terpopuler = $this->repository->all();

        return view('home.index', compact('terbaru', 'terpopuler'));
    }

}
