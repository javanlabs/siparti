<?php

namespace App\Presenters;

use App\Transformers\SatkerTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class SatkerPresenter
 *
 * @package namespace App\Presenters;
 */
class SatkerPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new SatkerTransformer();
    }
}
