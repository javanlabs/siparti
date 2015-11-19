<?php

namespace App\Transformers;

use App\Entities\ProgramKerjaUsulan;
use League\Fractal\TransformerAbstract;

class ProgramKerjaUsulanTransformer extends TransformerAbstract
{

    public function transform(ProgramKerjaUsulan $model)
    {
        return [
            'id'                => (int)$model->id,
            'name'              => $model->name,
            'manfaat'           => $model->manfaat,
            'lokasi'            => $model->lokasi,
            'target'            => $model->target,
            'description'       => $model->description,
            'komentar'          => $model->comment,
            'dukungan'          => $model->vote_up,
            'excerpt'           => str_limit($model->description),
            'creator_name'      => $model->creator->name,
            'creator_avatar'    => $model->creator->getAvatar(),
            'created_for_human' => $model->created_at->formatLocalized("%d %b '%y"),
            'url'               => route('proker-usulan.show', $model->id),

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
