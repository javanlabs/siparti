<?php

namespace App\Http\Controllers\My;

use App\Http\Requests\User\AddEmail;

class EmailController extends MyController
{
    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $user = auth()->user();
        return view('my.email.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param AddEmail $request
     * @return \Illuminate\Http\Response
     */
    public function update(AddEmail $request)
    {
        $email = $request->get('email');
        $token = $this->repository->addEmail($email, auth()->user()->getAuthIdentifier());

        \Mail::send('emails.new_email', compact('token'), function($message) use ($email){
            $message->subject('Konfirmasi perubahan email');
            $message->to($email);
        });

        \Notification::info(trans('users.new_email_activation', ['email' => $email]));
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $token
     * @return \Illuminate\Http\Response
     */
    public function activate($token)
    {
        if ($this->repository->activateEmail($token)) {
            \Notification::success('Email berhasil diperbarui');
        } else {
            \Notification::error('Token aktivasi tidak valid');
        }

        return redirect()->to('my/email');
    }


}
