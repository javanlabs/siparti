<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\SatkerPresenter;

/**
 * Class SatkerTransformer
 * @package namespace App\Transformers;
 */
class SatkerTransformer extends TransformerAbstract
{

    /**
     * Transform the \SatkerPresenter entity
     * @param \SatkerPresenter $model
     *
     * @return array
     */
    public function transform(SatkerPresenter $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
