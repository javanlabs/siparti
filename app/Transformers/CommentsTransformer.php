<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Comments;

/**
 * Class CommentsTransformer
 * @package namespace App\Transformers;
 */
class CommentsTransformer extends TransformerAbstract
{

    /**
     * Transform the \Comments entity
     * @param \Comments $model
     *
     * @return array
     */
    public function transform(Comments $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
