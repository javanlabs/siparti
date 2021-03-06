<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\ProgramKerja;
use App\Enum\FaseType;


/**
 * Class ProgramKerjaTransformer
 * @package namespace App\Transformers;
 */
class ProgramKerjaTransformer extends TransformerAbstract
{

    /**
     * Transform the \ProgramKerja entity
     * @param \ProgramKerja $model
     *
     * @return array
     */
    public function transform(ProgramKerja $model)
    {
        return [
            'id'                => (int) $model->id,
            'name'              => $model->name,
            'satker'            => $model->satker_id,
            'category_id'          => $model->category_id,
            'creator_name'      => $model->creator->name,
            'fase_sekarang'     => $model->getCurrentFase(),
            'satker_name'       => ($model->satker)?$model->satker->name:'',
            'date_for_human'    => date("d F Y",strtotime($model->created_at)),
            'usulan'            => $model->usulan,

            /* place your other model properties here */

            'created_at' => $model->created_at->formatLocalized('%e %B %Y'),
            'updated_at' => $model->updated_at
        ];
    }
}
