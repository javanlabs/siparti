<?php

namespace App\Http\Controllers\My;

use App\Http\Requests\User\AddEmail;
use Illuminate\Http\Request;
use Laravolt\Email\Email;

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
     * @param Request $request
     * @param Email $email
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Email $email)
    {
        $validator = $this->validator($request->all());
        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        $email->add($request->get('email'), auth()->user());
        \Notification::info(trans('email::email.new_email_activation', ['email' => $request->get('email')]));
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Email $email
     * @param $token
     * @return \Illuminate\Http\Response
     */
    public function activate(Email $email, $token)
    {
        if ($email->activate($token, auth()->user())) {
            \Notification::success(trans('email::email.activation_success'));
        } else {
            \Notification::error(trans('email::email.activation_failed'));
        }

        return redirect($this->redirectPath());
    }

    protected function validator(array $data)
    {
        return \Validator::make($data, [
            'email' => 'required|email|unique:users,email|max:255',
        ]);
    }

    protected function redirectPath()
    {
        return url('my/email');
    }
}
