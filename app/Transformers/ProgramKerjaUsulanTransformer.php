<?php

namespace App\Transformers;

use App\Entities\ProgramKerjaUsulan;
use League\Fractal\TransformerAbstract;

class ProgramKerjaUsulanTransformer extends TransformerAbstract
{

    public function transform(ProgramKerjaUsulan $model)
    {
        return [
            'id'           => (int)$model->id,
            'name'         => $model->name,
            'komentar'     => $model->comments()->count(),
            'dukungan'     => $model->vote_up,
            'excerpt'      => str_limit($model->description),
            'creator_name' => $model->creator->name,
            'creator_avatar' => $model->creator->getAvatar(),
            'created_for_human' => $model->created_at->formatLocalized("%d %b '%y"),

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
