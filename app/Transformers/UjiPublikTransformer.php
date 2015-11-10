<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\UjiPublikPresenter;

/**
 * Class UjiPublikTransformer
 * @package namespace App\Transformers;
 */
class UjiPublikTransformer extends TransformerAbstract
{

    /**
     * Transform the \UjiPublikPresenter entity
     * @param \UjiPublikPresenter $model
     *
     * @return array
     */
    public function transform(UjiPublikPresenter $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
