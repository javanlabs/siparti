<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Comments;

/**
 * Class CommentsTransformer
 * @package namespace App\Transformers;
 */
class CommentsTransformer extends TransformerAbstract
{

    /**
     * Transform the \Comments entity
     * @param \Comments $model
     *
     * @return array
     */
    public function transform(Comments $model)
    {
        return [
            'id'          => (int)$model->id,
            'author_name' => $model->author->name,
            'avatar'      => $model->getAvatar(),
            'content'     => $model->body,
            'commentable' => $model->commentable,
            /* place your other model properties here */

            'created_at' => $model->created_at->formatLocalized('%e %B %Y %H:%M:%S'),
            'updated_at' => $model->updated_at->formatLocalized('%e %B %Y')
        ];
    }
}
