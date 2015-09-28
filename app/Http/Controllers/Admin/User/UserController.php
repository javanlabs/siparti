<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateAccount;
use App\Repositories\UserRepositoryEloquent;
use Krucas\Notification\Facades\Notification;
use App\Repositories\TimezoneRepositoryArray;


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
        return view('admin.users.create');
    }

    /**
     * Store the specified resource.
     *
     * @param CreateAccount $request
     * @return Response
     */
    public function store(CreateAccount $request)
    {
        $this->repository->create($request->only('name', 'email', 'password', 'status'));
        Notification::success(trans('users.creation_success'));
        return redirect()->route('admin.users.index');
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

    public function destroy($id)
    {
        $this->repository->delete($id);
        Notification::warning('User berhasil dihapus');
        return redirect(route('admin.users.index'));
    }
}
