<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\SatkerRepository;
use App\Presenters\SatkerPresenter;
use App\Entities\Satker;

/**
 * Class SatkerRepositoryEloquent
 * @package namespace App\Repositories;
 */
class SatkerRepositoryEloquent extends BaseRepository implements SatkerRepository
{
    
    protected $skipPresenter = true;
    
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Satker::class;
    }
    
    /*
     * set presenter class
     */
    public function presenter()
    {
        return SatkerPresenter::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function lists()
    {
        return $this->model->lists('name', 'id')->prepend('-- Semua Satker --');
    }
}
