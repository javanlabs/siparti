<?php

namespace App\Repositories;

use App\Criteria\ProgramKerjaUsulanRequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Entities\ProgramKerjaUsulan;
use App\Presenters\ProgramKerjaUsulanPresenter;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Class ProgramKerjaUsulanRepositoryEloquent
 * @package namespace App\Repositories;
 */
class ProgramKerjaUsulanRepositoryEloquent extends BaseRepository implements ProgramKerjaUsulanRepository
{

    protected $skipPresenter = true;

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ProgramKerjaUsulan::class;
    }

    public function presenter()
    {
        return ProgramKerjaUsulanPresenter::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
        $this->pushCriteria(app(ProgramKerjaUsulanRequestCriteria::class));
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
