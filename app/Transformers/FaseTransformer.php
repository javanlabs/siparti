<?php

namespace App\Transformers;

use App\Entities\ProgramKerja;
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
            'scope'            => $model->scope,
            'target'           => $model->target,
            'process'          => $model->process,
            'kendala'          => $model->kendala,
            'instansi_terkait' => $model->instansi_terkait,
            'periode'          => $model->start_date->formatLocalized('%e %B %Y') . ' s/d ' . $model->end_date->formatLocalized('%e %B %Y'),
            'pic'              => $model->pic,
            'pagu'             => $model->pagu,


            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }

    public function includeProgramKerja(Fase $fase)
    {
        return $this->item($fase->programKerja, new ProgramKerjaTransformer());
    }
}