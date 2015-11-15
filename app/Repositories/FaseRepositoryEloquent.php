<?php

namespace App\Repositories;

use App\Enum\FaseType;
use App\Presenters\FasePresenter;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;
use App\Criteria\ProgramKerjaSearchCriteria;

use App\Entities\Fase;

/**
 * Class FaseRepositoryEloquent
 * @package namespace App\Repositories;
 */
class FaseRepositoryEloquent extends BaseRepository implements FaseRepository
{

    protected $skipPresenter = true;

    //protected $fieldSearchable = [
    //    'name' => 'like',
    //    'satker_id',
    //    'type'
    //];
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Fase::class;
    }

    public function presenter()
    {
        return FasePresenter::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
        $this->pushCriteria(app(ProgramKerjaSearchCriteria::class));
    }

    public function lists()
    {
        return collect(FaseType::toArray())->prepend('-- Semua Fase --');
    }

    public function terbaru($limit)
    {
        $results = $this->model->latest()->limit($limit)->get();

        return $this->parserResult($results);
    }

    public function terpopuler($limit)
    {
        $results = $this->model->mostVoted()->limit($limit)->get();

        return $this->parserResult($results);
    }

    public function yearOptions($emptyText = null)
    {
        $years = collect(array_combine($range = range(date('Y'), settings('app.min_year', 2000)), $range));

        if ($emptyText) {
            $years->prepend($emptyText, 0);
        }

        return $years;
    }

    public function paginateArsip()
    {
        $this->model = $this->model->arsip();
        return $this->paginate();
    }

    public function paginateBerjalan()
    {
        $this->model = $this->model->berjalan();
        return $this->paginate();
    }

    public function getRelated($fase)
    {
        return $this->parserResult($fase->related);
    }

    public function getDocuments($fase)
    {
        return $fase->getMedia();
    }
}
