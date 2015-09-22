<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Requests;
use Krucas\Notification\Facades\Notification;
use Laravolt\Auth\Password;
use Illuminate\Mail\Message;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepositoryEloquent;

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
     * @param Password $password
     */
    public function __construct(UserRepositoryEloquent $repository, Password $password)
    {
        $this->repository = $repository;
        $this->password = $password;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = $this->repository->find($id)['data'];
        return view('admin.users.password.edit', compact('user'));
    }

    public function reset($id)
    {
        $this->password->sendResetLink(['id' => $id]);
        Notification::success('Email reset password telah dikirimkan.');
        return redirect()->back();
    }

    public function generate($id)
    {
        $this->password->sendNewPassword($this->repository->skipPresenter()->find($id));
        Notification::success('Password berhasil diganti dan telah dikirim ke email.');
        return redirect()->back();
    }
}
