<?php

namespace Siparti\UjiPublik;

use League\Fractal\TransformerAbstract;

class Transformer extends TransformerAbstract
{

    protected $defaultIncludes = [];

    public function transform(Model $model)
    {
        return [
            'id'         => (int)$model->id,
            'name'       => $model->name,
            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at,
        ];
    }

}
