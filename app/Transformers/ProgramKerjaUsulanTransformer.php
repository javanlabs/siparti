<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\ProgramKerjaUsulanPresenter;

/**
 * Class ProgramKerjaUsulanTransformer
 * @package namespace App\Transformers;
 */
class ProgramKerjaUsulanTransformer extends TransformerAbstract
{

    /**
     * Transform the \ProgramKerjaUsulanPresenter entity
     * @param \ProgramKerjaUsulanPresenter $model
     *
     * @return array
     */
    public function transform(ProgramKerjaUsulanPresenter $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
