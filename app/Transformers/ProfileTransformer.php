<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Profile;

/**
 * Class ProfileTransformer
 * @package namespace App\Transformers;
 */
class ProfileTransformer extends TransformerAbstract
{

    /**
     * Transform the \Profile entity
     * @param Profile $model
     * @return array
     */
    public function transform(Profile $model)
    {
        return [
            'id'       => (int)$model->id,
            'bio'      => $model->bio,
            'timezone' => $model->timezone,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
