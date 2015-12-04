<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Category;

/**
 * Class SatkerTransformer
 * @package namespace App\Transformers;
 */
class CategoryTransformer extends TransformerAbstract
{

    /**
     * Transform the \SatkerPresenter entity
     * @param \SatkerPresenter $model
     *
     * @return array
     */
    public function transform(Category $model)
    {
        return [
            'id'         => (int) $model->id,
            'name'       => $model->name,
            'status'     => $model->status,
            'parent_id'  => (int)$model->parent_id,
            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
