<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\UserRepositoryEloquent;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class PasswordController extends Controller
{
    /**
     * @var UserRepositoryEloquent
     */
    private $repository;

    /**
     * PasswordController constructor.
     * @param UserRepositoryEloquent $repository
     */
    public function __construct(UserRepositoryEloquent $repository)
    {
        $this->repository = $repository;
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
        return view('admin.password.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

}
