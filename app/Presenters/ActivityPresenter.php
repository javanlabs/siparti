<?php

namespace App\Presenters;

use App\Transformers\ActivityTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class ActivityPresenter
 *
 * @package namespace App\Presenters;
 */
class ActivityPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ActivityTransformer();
    }
}
