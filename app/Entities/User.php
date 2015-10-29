<?php

namespace App\Entities;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Laravolt\Acl\Contracts\HasRoleAndPermission as HasRoleAndPermissionContract;
use Laravolt\Acl\Traits\HasRoleAndPermission;
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
    Presentable,
    HasRoleAndPermissionContract
{
    use Authenticatable, Authorizable, CanResetPassword, CanChangePassword, PresentableTrait, HasSocialAccount, HasRoleAndPermission;

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

    protected static function boot()
    {
        static::created(function ($user) {
            $user->profile()->save(new Profile());
        });
    }

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
        return Avatar::create($this->attributes['name'])->toBase64();
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

    public function getAvatar()
    {
        return Avatar::create($this->name)->toBase64();
    }

    function __toString()
    {
        return $this->name;
    }


}
