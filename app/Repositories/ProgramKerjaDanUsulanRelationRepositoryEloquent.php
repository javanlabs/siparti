<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ProgramKerjaDanUsulanRelationRepository;
use App\Entities\ProgramKerjaDanUsulanRelation;

/**
 * Class ProgramKerjaDanUsulanRelationRepositoryEloquent
 * @package namespace App\Repositories;
 */
class ProgramKerjaDanUsulanRelationRepositoryEloquent extends BaseRepository implements ProgramKerjaDanUsulanRelationRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ProgramKerjaDanUsulanRelation::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
