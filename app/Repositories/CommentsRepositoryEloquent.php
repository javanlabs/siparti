<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\CommentsRepository;
use Laravolt\Mural\Comment;

/**
 * Class CommentsRepositoryEloquent
 * @package namespace App\Repositories;
 */
class CommentsRepositoryEloquent extends BaseRepository implements CommentsRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Comment::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    
}
