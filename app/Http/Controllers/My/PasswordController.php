<?php

namespace App\Http\Controllers\My;

use App\Http\Requests\User\UpdatePassword;
use Krucas\Notification\Facades\Notification;

class PasswordController extends MyController
{
    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $user = auth()->user();
        return view('my.password.edit', compact('user'));
    }

    public function update(UpdatePassword $request)
    {
        $user = auth()->user();
        $this->repository->updatePassword($request->get('password'), $user->id);
        Notification::success('Password berhasil diperbarui.');
        return redirect()->back();
    }
}
