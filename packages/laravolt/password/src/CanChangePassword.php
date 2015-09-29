<?php
namespace Laravolt\Password;

use Carbon\Carbon;

trait CanChangePassword
{
    /**
     * @param $password
     * @param bool $mustBeChanged
     * @return $this
     */
    public function setPassword($password, $mustBeChanged = false)
    {
        $this->password = bcrypt($password);
        $this->password_last_set = new Carbon();

        if ($mustBeChanged) {
            $this->password_last_set = null;
        }

        return $this->save();
    }

    /**
     * @return bool
     */
    public function passwordMustBeChanged()
    {
        return $this->attributes['password_last_set'] == null;
    }

    public function getEmailForNewPassword()
    {
        return $this->email;
    }
}
