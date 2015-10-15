<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Requests;
use Illuminate\Http\Request;

class AccountController extends UserController
{

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = $this->repository->skipPresenter()->find($id);
        return view('admin.users.account.edit', compact('user'));
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
        $this->repository->update($request->except('_token'), $id);
        return redirect()->back();
    }

}
