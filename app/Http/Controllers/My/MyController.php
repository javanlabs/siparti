<?php

namespace App\Http\Controllers\My;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepositoryEloquent;
use Krucas\Notification\Facades\Notification;
use App\Repositories\TimezoneRepositoryArray;


class MyController extends Controller
{
    /**
     * @var UserRepositoryEloquent
     */
    protected $repository;

    /**
     * @var TimezoneRepositoryArray
     */
    protected $timezone;

    /**
     * UserController constructor.
     * @param UserRepositoryEloquent $repository
     * @param TimezoneRepositoryArray $timezone
     */
    public function __construct(UserRepositoryEloquent $repository, TimezoneRepositoryArray $timezone)
    {
        $this->repository = $repository;
        $this->timezone = $timezone;

    }

}
