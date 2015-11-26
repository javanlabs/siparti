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
            'instansi_terkait'  => $model->instansi_stakeholder,
            'dukungan'          => $model->vote_up,
            'penolakan'         => $model->vote_down,
            'excerpt'           => str_limit($model->description),
            'deskripsi'         => $model->description,
            'creator_name'      => $model->creator->name,
            'creator_avatar'    => $model->creator->getAvatar(),
            'created_for_human' => $model->created_at->formatLocalized("%d %b '%y"),
            'url'               => route('proker-usulan.show', $model->id),
            'media'             => $model->getMedia(),

            'created_at' => $model->created_at->formatLocalized('%e %B %Y'),
            'updated_at' => $model->updated_at
        ];
    }
}
