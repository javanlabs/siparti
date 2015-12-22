<?php

namespace App\Repositories;

use App\Presenters\ProgramKerjaPresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ProgramKerjaRepository;
use Prettus\Repository\Events\RepositoryEntityCreated;
use Prettus\Repository\Events\RepositoryEntityDeleted;
use App\Criteria\ProgramKerjaSearchCriteria;
use App\Entities\ProgramKerja;
use Auth;

/**
 * Class ProgramKerjaRepositoryEloquent
 * @package namespace App\Repositories;
 */
class ProgramKerjaRepositoryEloquent extends BaseRepository implements ProgramKerjaRepository
{
    protected $skipPresenter = true;

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ProgramKerja::class;
    }

    public function presenter()
    {
        return ProgramKerjaPresenter::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
        $this->pushCriteria(app(ProgramKerjaSearchCriteria::class));

        $this->scopeQuery(function($model){
            return $model->latest();
        });
    }

}
