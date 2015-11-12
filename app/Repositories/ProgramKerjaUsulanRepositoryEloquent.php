<?php

namespace App\Repositories;

use App\Criteria\ProgramKerjaUsulanRequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Entities\ProgramKerjaUsulan;
use App\Presenters\ProgramKerjaUsulanPresenter;

/**
 * Class ProgramKerjaUsulanRepositoryEloquent
 * @package namespace App\Repositories;
 */
class ProgramKerjaUsulanRepositoryEloquent extends BaseRepository implements ProgramKerjaUsulanRepository
{

    protected $skipPresenter = true;
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ProgramKerjaUsulan::class;
    }

    public function presenter()
    {
        return ProgramKerjaUsulanPresenter::class;
    }
    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(ProgramKerjaUsulanRequestCriteria::class));
    }
}
