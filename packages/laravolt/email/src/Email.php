<?php
namespace Laravolt\Email;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Contracts\Config\Repository;

class Email
{
    protected $config;

    protected $mailer;

    /**
     * Email constructor.
     * @param $config
     * @param $mailer
     * @internal param $app
     */
    public function __construct(Repository $config, Mailer $mailer)
    {
        $this->config = $config;
        $this->mailer = $mailer;
    }

    public function add($email, $user)
    {
        $token = Str::random(40);
        $saved = DB::table('users_emails')->insert([
            'user_id'    => $user->id,
            'email'      => $email,
            'token'      => $token,
            'created_at' => new Carbon(),
            'updated_at' => new Carbon(),
        ]);

        if ($saved) {
            $view = $this->config->get('email.activation');
            $url = url('my/email/activation/' . $token);

            $this->mailer->send($view, compact('url'), function ($message) use ($email) {
                $message->subject(trans('email::email.activation_subject'));
                $message->to($email);
            });
        }

        return $saved;
    }

    public function activate($token, $user)
    {
        $email = \DB::table('users_emails')->whereToken($token)->first();

        if (!$email) {
            return false;
        }

        $data = ['email' => $email->email];
        $user->update($data, $email->user_id);

        \DB::table('users_emails')->whereEmail($email->email)->delete();

        return true;

    }
}
