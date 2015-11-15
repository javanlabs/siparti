<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\UjiPublik;

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
    public function transform(UjiPublik $model)
    {
        return [
            'id'      => (int)$model->id,
            'name'    => $model->name,
            'url'     => route('uji-publik.show', $model->id),
            'tahun'   => $model->created_at->format('Y'),
            'materi'  => $model->materi,
            'excerpt' => str_limit($model->materi, 200),
            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
