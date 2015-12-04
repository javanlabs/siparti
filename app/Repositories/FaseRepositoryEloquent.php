<?php

namespace App\Repositories;

use App\Enum\FaseType;
use App\Presenters\FasePresenter;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;
use App\Criteria\ProgramKerjaSearchCriteria;

use App\Entities\Fase;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Prettus\Repository\Events\RepositoryEntityCreated;
use Prettus\Repository\Events\RepositoryEntityUpdated;



/**
 * Class FaseRepositoryEloquent
 * @package namespace App\Repositories;
 */
class FaseRepositoryEloquent extends BaseRepository implements FaseRepository
{

    protected $skipPresenter = true;

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
        //$this->pushCriteria(app(ProgramKerjaSearchCriteria::class));
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

    public function getSiblings($fase)
    {
        return $this->parserResult($fase->siblings());
    }

    public function getDocuments($fase)
    {
        return $fase->getMedia();
    }

    public function attachDocuments(Fase $model, $files)
    {

       foreach ($files as $file) {
            if ($file instanceof UploadedFile) {
                $model->addMedia($file)->toCollection('media');
            }
        }
    }

    public function create(array $attributes)
    {

        $model = $this->model->newInstance($attributes);

        $model->save();

        if($attributes['tags']) {

            $tags = explode(",", $attributes['tags']);

            foreach ($tags as $tag) {

                $model->tag($tag);
            }
        }

        foreach ($attributes['file'] as $data) {

            if ($data instanceof UploadedFile) {

                $model->addMedia($data)->preservingOriginal()->toCollection('media');
            }
        }


        $this->resetModel();

        event(new RepositoryEntityCreated($this, $model));

        return $this->parserResult($model);
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

        $tags = explode(",", $this->sanitize($attributes['tags']));

        $model->untag();

        foreach($tags as $tag) {

            $model->tag($tag);

        }

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

    private function sanitize($str)
    {

        $sanitized = preg_replace('/\s\s+/', ' ', $str);

        $sanitized = str_replace(" ", "", $sanitized);

        return $sanitized;
    }

}
