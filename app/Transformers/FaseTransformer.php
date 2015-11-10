<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Fase;

/**
 * Class FaseTransformer
 * @package namespace App\Transformers;
 */
class FaseTransformer extends TransformerAbstract
{

    /**
     * Transform the \Fase entity
     * @param \Fase $model
     *
     * @return array
     */
    public function transform(Fase $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
