<?php

namespace App\Http\Controllers\Admin\User;

use App\Enum\Permission;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Requests;
use App\Http\Requests\User\CreateAccount;
use App\Repositories\UserRepositoryEloquent;
use Illuminate\Support\Facades\Mail;
use Krucas\Notification\Facades\Notification;
use App\Repositories\TimezoneRepositoryArray;


class UserController extends AdminController
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

        $this->authorize(Permission::MANAGE_USER);

        parent::__construct();
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
        // save to db
        $user = $this->repository->createByAdmin($request->only('name', 'email', 'password', 'status', 'must_change_password'));
        $password = $request->get('password');

        // send account info to email
        if($request->has('send_account_information')) {
            Mail::send('emails.account_information', compact('user', 'password'), function($message) use ($user) {
                $message->subject('Your Account Information');
                $message->to($user->email);
            });
        }

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
