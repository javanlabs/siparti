<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ProgramKerjaUsulanRepository;
use App\Entities\ProgramKerjaUsulan;

/**
 * Class ProgramKerjaUsulanRepositoryEloquent
 * @package namespace App\Repositories;
 */
class ProgramKerjaUsulanRepositoryEloquent extends BaseRepository implements ProgramKerjaUsulanRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ProgramKerjaUsulan::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
