<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\FaseRepository;
use App\Entities\Fase;

/**
 * Class FaseRepositoryEloquent
 * @package namespace App\Repositories;
 */
class FaseRepositoryEloquent extends BaseRepository implements FaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Fase::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
