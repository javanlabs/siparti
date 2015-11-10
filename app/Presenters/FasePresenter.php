<?php

namespace App\Presenters;

use App\Transformers\FaseTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class FasePresenter
 *
 * @package namespace App\Presenters;
 */
class FasePresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new FaseTransformer();
    }
}
