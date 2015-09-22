<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Requests\User\AdminEditProfile;
use App\Repositories\TimezoneRepositoryArray;
use App\Repositories\UserRepositoryEloquent;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * @var UserRepositoryEloquent
     */
    protected $repository;

    /**
     * @var TimezoneRepositoryArray
     */
    protected $timezone;

    /**
     * UserController constructor.
     * @param UserRepositoryEloquent $repository
     * @param TimezoneRepositoryArray $timezone
     */
    public function __construct(UserRepositoryEloquent $repository, TimezoneRepositoryArray $timezone)
    {
        $this->repository = $repository;
        $this->timezone = $timezone;

        //$this->middleware('menus.admin');
    }


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $users = $this->repository->skipPresenter()->paginate();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        return redirect(route('admin.profile.edit', $id));
    }
}
