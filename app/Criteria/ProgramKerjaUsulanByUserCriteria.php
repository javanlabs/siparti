<?php
namespace App\Criteria;

use App\Entities\User;
use Prettus\Repository\Contracts\RepositoryInterface; 
use Prettus\Repository\Contracts\CriteriaInterface;
use App\Presenters\UserPresenter;

class ProgramKerjaUsulanByUserCriteria implements CriteriaInterface {

    public function apply($model, RepositoryInterface $repository)
    {
        $user = auth()->user()->setPresenter(new UserPresenter());
        $model = $model->where('creator_id','=', $user->id );
        return $model;
    }
}
