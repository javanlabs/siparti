<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\CategoryRepository;
use App\Presenters\CategoryPresenter;
use App\Entities\Category;

/**
 * Class SatkerRepositoryEloquent
 * @package namespace App\Repositories;
 */
class CategoryRepositoryEloquent extends BaseRepository implements CategoryRepository
{
    
    protected $skipPresenter = true;
    
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Category::class;
    }
    
    /*
     * set presenter class
     */
    public function presenter()
    {
        return CategoryPresenter::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function getParent(){
        $categories = Category::where('parent_id',0)->orderBy('name', 'asc')->get();
        return $categories;
    }

    public function getCategories(){
        $categories = $this->getParent();
        $categories = $this->addRelation($categories);
        return $categories;
    }

    public function addRelation($categories){
        $categories->map(function($item, $key){
            $sub = $this->selectChild($item->id);
            return $item = array_add($item, 'subCategory', $sub);
        });
        return $categories;
    }

    public function selectChild($id){
        $categories = Category::where('parent_id',$id)->orderBy('name', 'asc')->get();
        return $categories;
    }

    public function lists()
    {
        return $this->model->lists('name', 'id')->prepend('-- Semua Kategori --', 0);
    }
}
