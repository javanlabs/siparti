<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ProgramKerjaUsulanRepository;
use App\Entities\ProgramKerjaUsulan;
use Prettus\Repository\Events\RepositoryEntityCreated;


/**
 * Class ProgramKerjaUsulanRepositoryEloquent
 * @package namespace App\Repositories;
 */
class ProgramKerjaUsulanRepositoryEloquent extends BaseRepository implements ProgramKerjaUsulanRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ProgramKerjaUsulan::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function create(array $attributes)
    {

        if ( !is_null($this->validator) ) {
            $this->validator->with($attributes)
                ->passesOrFail( ValidatorInterface::RULE_CREATE );
        }

        $model = $this->model->newInstance();

        $model->name = $attributes["namaProgram"];
        $model->instansi_stakeholder = $attributes['instansiTerkait'];
        $model->description = $attributes['description'];
        
        $model->save();

        $model->addMedia($attributes['file'])->toCollection('media');


        $this->resetModel();

        event(new RepositoryEntityCreated($this, $model));

        return $this->parserResult($model);
    }
}
