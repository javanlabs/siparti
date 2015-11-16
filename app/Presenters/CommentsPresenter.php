<?php

namespace App\Presenters;

use App\Transformers\CommentsTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class CommentsPresenter
 *
 * @package namespace App\Presenters;
 */
class CommentsPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new CommentsTransformer();
    }
}
