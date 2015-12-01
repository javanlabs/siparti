<?php

namespace App\Entities;

use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Prettus\Repository\Contracts\Presentable;
use Prettus\Repository\Traits\PresentableTrait;
use Spatie\Activitylog\Models\Activity as BaseActivity;

class Activity extends BaseActivity implements Transformable, Presentable
{
    use TransformableTrait;
    use PresentableTrait;


    public function getUserName()
    {

        if (!$this->user) {

            return "Anonymous";

        }

        return $this->user->name;
    }

    public function getUserEmail()
    {
        if (!$this->user) {

            return "Anonymous";

        }

        return $this->user->email;
    }

}
