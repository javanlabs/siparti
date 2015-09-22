<?php

namespace App\Http\Controllers\My;

use App\Http\Requests;
use Illuminate\Http\Request;

class AccountController extends MyController
{

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $user = auth()->user();
        return view('my.account.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
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

}
