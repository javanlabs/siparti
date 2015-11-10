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
            'id'     => (int)$model->id,
            'name'   => $model->programKerja['name'],
            'satker' => $model->programKerja['satker']['name'],
            'fase'   => $model->type,
            'tahun'  => $model->start_date->format('Y'),

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }

    public function includeProgramKerja(Fase $fase)
    {
        return $this->item($fase->programKerja, new ProgramKerjaTransformer());
    }
}
