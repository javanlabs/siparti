<?php

namespace App\Repositories;

use App\Criteria\UjiPublikSearchCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;
use App\Entities\UjiPublik;
use App\Presenters\UjiPublikPresenter;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Prettus\Repository\Events\RepositoryEntityUpdated;


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
        $this->pushCriteria(app(UjiPublikSearchCriteria::class));
        $this->pushCriteria(app(RequestCriteria::class));
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
    
    public function update(array $attributes, $id)
    {
        $this->applyScope();
    
        if ( !is_null($this->validator) ) {
            $this->validator->with($attributes)
            ->setId($id)
            ->passesOrFail( ValidatorInterface::RULE_UPDATE );
        }
    
        $_skipPresenter = $this->skipPresenter;
    
        $this->skipPresenter(true);
    
        $model = $this->model->findOrFail($id);
        $model->fill($attributes);
        $model->save();
    
        if (isset($attributes['deletedMedia'])) {
    
            $media = $model->getMedia();
    
            foreach( $attributes['deletedMedia'] as $id) {
    
                $media[$id]->delete();
            }
        }
    
        foreach ($attributes['file'] as $data) {
    
            if ($data instanceof UploadedFile) {
    
                $model->addMedia($data)->preservingOriginal()->toCollection('media');
            }
        }
    
    
        $this->skipPresenter($_skipPresenter);
        $this->resetModel();
    
        event(new RepositoryEntityUpdated($this, $model));
    
        return $this->parserResult($model);
    }   
}
