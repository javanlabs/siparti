<?php

namespace App\Repositories;

use App\Criteria\UjiPUblikSearchCriteria;
use Prettus\Repository\Eloquent\BaseRepository;
use App\Entities\UjiPublik;
use App\Presenters\UjiPublikPresenter;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Class UjiPublikRepositoryEloquent
 * @package namespace App\Repositories;
 */
class UjiPublikRepositoryEloquent extends BaseRepository implements UjiPublikRepository
{

    protected $skipPresenter = true;

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return UjiPublik::class;
    }

    public function presenter()
    {
        return UjiPublikPresenter::class;
    }
    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(UjiPUblikSearchCriteria::class));
    }

    public function yearOptions($emptyText = null)
    {
        $years = collect(array_combine($range = range(date('Y'), settings('app.min_year', 2000)), $range));

        if ($emptyText) {
            $years->prepend($emptyText, 0);
        }

        return $years;
    }

    public function create(array $attributes)
    {
        $model = $this->model->newInstance($attributes);
        $model->creator()->associate(auth()->user());
        $model->save();
        $this->resetModel();

        return $this->parserResult($model);
    }


    public function attachDocument($model, $files)
    {
        $files = (array)$files;

        foreach ($files as $file) {
            if ($file instanceof UploadedFile) {
                $model->addDocument($file);
            }
        }

        return $model;
    }

    public function getDocuments($model)
    {
        return $model->getMedia();
    }
}
