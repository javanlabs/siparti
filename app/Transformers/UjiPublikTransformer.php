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
            'id'                => (int)$model->id,
            'name'              => $model->name,
            'url'               => route('uji-publik.show', $model->id),
            'tahun'             => $model->created_at->format('Y'),
            'materi'            => $model->materi,
            'excerpt'           => str_limit($model->materi, 200),
            'dukungan'          => $model->vote_up,
            'penolakan'         => $model->vote_down,
            'komentar'          => $model->comment,
            'created_at'        => $model->created_at->formatLocalized('%e %B %Y'),
            'updated_at'        => $model->updated_at->formatLocalized('%e %B %Y'),
            'creator_name'      => $model->creator->name,
            'media'             => $model->getMedia(),
            'url'               => route('uji-publik.show', $model->id),
        ];
    }
}
