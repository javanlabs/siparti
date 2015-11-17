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

    public function paginate($limit = null, $columns = array('*'))
    {
        $this->applyCriteria();
        $this->applyScope();
        $limit = is_null($limit) ? config('repository.pagination.limit', 15) : $limit;
        $results = $this->model->orderBy('created_at', "DESC")->paginate($limit, $columns);
        $this->resetModel();
        return $this->parserResult($results);
    }

    public function delete($id)
    {
        return \Mural::remove($id);
    }


}
