<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Activity;

/**
 * Class ActivityTransformer
 * @package namespace App\Transformers;
 */
class ActivityTransformer extends TransformerAbstract
{

    /**
     * Transform the \Activity entity
     * @param \Activity $model
     *
     * @return array
     */
    public function transform(Activity $model)
    {
        return [
            'id'         => (int) $model->id,
            
            'ip_address' => $model->ip_address,
            'activity'  =>  $model->text,
            'user_id'   => $model->user_id,    
            'name'      => $model->getUserName(),
            'email'     => $model->getUserEmail(),
                
            /* place your other model properties here */
            
            'date_for_human' => date("d F Y",strtotime($model->created_at)),
            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
