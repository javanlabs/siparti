<?php
namespace Laravolt\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

trait Activation
{
    public function postRegister(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        $user = $this->create($request->all());
        $token = $this->createToken($user);

        Mail::send('auth::auth.activation', compact('token'), function($message) use ($user){
            $message->subject(trans('auth.activation_subject'));
            $message->to($user['email']);
        });

        //flash()->warning(trans('auth.activation_needed'));
        return redirect()->back();
    }

    public function getActivate(UserRepository $user, $token)
    {
        $userId = DB::table('users_activation')->whereToken($token)->pluck('user_id');

        if (!$userId) {
            abort(404);
        }

        $user->activate($userId);
        flash()->success(trans('auth.activation_success'));
        return redirect()->to('auth/login');
    }

    protected function createToken($user)
    {
        $token = md5(uniqid(rand(), true));
        DB::table('users_activation')->insert(['user_id' => $user->getKey(), 'token' => $token]);

        return $token;
    }
}
