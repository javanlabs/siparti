<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Satker;

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
    public function transform(Satker $model)
    {
        return [
            'id'         => (int) $model->id,
            'name'       => $model->name,   

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
