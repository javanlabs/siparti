<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ActivityRepository;
use App\Entities\Activity;
use App\Presenters\ActivityPresenter;

/**
 * Class ActivityRepositoryEloquent
 * @package namespace App\Repositories;
 */
class ActivityRepositoryEloquent extends BaseRepository implements ActivityRepository
{

    protected $skipPresenter = true;

    protected $fieldSearchable = [
        'created_at' => 'like',
        'text'       => 'like',
    ];

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Activity::class;
    }

    public function presenter()
    {
        return ActivityPresenter::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
        $this->scopeQuery(function ($query) {
            return $query->with('user')->latest();
        });
    }
}
