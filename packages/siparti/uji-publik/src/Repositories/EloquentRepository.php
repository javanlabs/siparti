<?php

namespace Siparti\UjiPublik\Repositories;

use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;
use Siparti\UjiPublik\Model;
use Siparti\UjiPublik\Presenter;

class EloquentRepository extends BaseRepository implements RepositoryInterface
{

    protected $skipPresenter = true;

    protected $fieldSearchable = [
        'name' => 'like'
    ];

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Model::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function presenter()
    {
        return Presenter::class;
    }

}
