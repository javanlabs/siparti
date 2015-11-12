<?php

namespace App\Transformers;

use App\Entities\ProgramKerja;
use App\Enum\FaseType;
use League\Fractal\TransformerAbstract;
use App\Entities\Fase;

/**
 * Class FaseTransformer
 * @package namespace App\Transformers;
 */
class FaseTransformer extends TransformerAbstract
{

    protected $defaultIncludes = [
        'programKerja'
    ];

    /**
     * Transform the \Fase entity
     * @param \Fase $model
     *
     * @return array
     */
    public function transform(Fase $model)
    {
        return [
            'id'               => (int)$model->id,
            'name'             => $model->programKerja['name'],
            'status'           => title_case($model->type),
            'satker'           => $model->satker['name'],
            'fase'             => $model->type,
            'tahun'            => $model->start_date->format('Y'),
            'url'              => route('proker.show', $model->id),
            'description'      => $model->description,
            'excerpt'          => str_limit($model->description, 150),
            'scope'            => $model->scope,
            'target'           => $model->target,
            'process'          => $model->process,
            'kendala'          => $model->kendala,
            'instansi_terkait' => $model->instansi_terkait,
            'periode'          => $model->start_date->formatLocalized('%e %B %Y') . ' - ' . $model->end_date->formatLocalized('%e %B %Y'),
            'pic'              => $model->pic,
            'pagu'             => $model->pagu,
            'komentar'         => $model->comments()->count(),
            'dukungan'         => $model->vote_up,
            'label'            => (new FaseType($model->type))->label(),


            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }

    public function includeProgramKerja(Fase $fase)
    {
        return $this->item($fase->programKerja, new ProgramKerjaTransformer());
    }
}
