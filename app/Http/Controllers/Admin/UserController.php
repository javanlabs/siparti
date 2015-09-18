<?php

namespace App\Http\Controllers\Admin;

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
    private $repository;

    /**
     * @var TimezoneRepositoryArray
     */
    private $timezone;

    /**
     * UserController constructor.
     * @param UserRepositoryEloquent $repository
     * @param TimezoneRepositoryArray $timezone
     */
    public function __construct(UserRepositoryEloquent $repository, TimezoneRepositoryArray $timezone)
    {
        $this->repository = $repository;
        $this->timezone = $timezone;
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
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
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
        $user = $this->repository->skipPresenter()->find($id);
        $timezones = $this->timezone->lists();

        return view('admin.users.edit', compact('user', 'timezones'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param AdminEditProfile $request
     * @param  int $id
     * @return Response
     */
    public function update(AdminEditProfile $request, $id)
    {
        $this->repository->update($request->only('name', 'email', 'status', 'bio', 'timezone'), $id);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
