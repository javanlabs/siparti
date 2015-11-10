<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\UjiPublikRepository;
use App\Entities\UjiPublik;

/**
 * Class UjiPublikRepositoryEloquent
 * @package namespace App\Repositories;
 */
class UjiPublikRepositoryEloquent extends BaseRepository implements UjiPublikRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return UjiPublik::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
