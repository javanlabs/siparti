<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Requests;
use Illuminate\Http\Request;
use Laravolt\Password\Password;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepositoryEloquent;
use Krucas\Notification\Facades\Notification;

class PasswordController extends Controller
{
    /**
     * @var UserRepositoryEloquent
     */
    private $repository;

    /**
     * @var Password
     */
    private $password;

    /**
     * PasswordController constructor.
     * @param UserRepositoryEloquent $repository
     */
    public function __construct(UserRepositoryEloquent $repository)
    {
        $this->repository = $repository;
        $this->password = app('password');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = $this->repository->skipPresenter()->find($id);
        return view('admin.users.password.edit', compact('user'));
    }

    public function reset($id)
    {
        $this->password->sendResetLink(['id' => $id]);
        Notification::success('Email reset password telah dikirimkan.');
        return redirect()->back();
    }

    public function generate(Request $request, $id)
    {
        $user = $this->repository->skipPresenter()->find($id);
        $this->password->sendNewPassword($user, $request->has('must_change_password'));

        Notification::success('Password berhasil diganti dan telah dikirim ke email.');
        return redirect()->back();
    }
}
