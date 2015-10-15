<?php

namespace App\Entities;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Laravolt\Auth\Traits\HasSocialAccount;
use Laravolt\Mural\Contracts\Commentator;
use Laravolt\Password\CanChangePassword;
use Laravolt\Password\CanChangePasswordContract;
use Prettus\Repository\Contracts\Presentable;
use Prettus\Repository\Traits\PresentableTrait;
use Avatar;

class User extends Model implements AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract,
    CanChangePasswordContract,
    Commentator,
    Presentable
{
    use Authenticatable, Authorizable, CanResetPassword, CanChangePassword, PresentableTrait, HasSocialAccount;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password', 'status'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    protected $dates = ['password_last_set'];

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function getCommentatorNameAttribute()
    {
        return $this['name'];
    }

    public function getCommentatorAvatarAttribute()
    {
        return Avatar::data($this->attributes['name']);
    }

    public function getCommentatorPermalinkAttribute()
    {
        return url('users/' . $this->id);
    }

    public function canModerateComment()
    {
        return true;
    }

    public function getTimezoneAttribute()
    {
        if ($this->profile) {
            return $this->profile->timezone;
        }

        return config('app.timezone');
    }
}
