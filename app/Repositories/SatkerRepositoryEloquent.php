<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\SatkerRepository;
use App\Entities\Satker;

/**
 * Class SatkerRepositoryEloquent
 * @package namespace App\Repositories;
 */
class SatkerRepositoryEloquent extends BaseRepository implements SatkerRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Satker::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
