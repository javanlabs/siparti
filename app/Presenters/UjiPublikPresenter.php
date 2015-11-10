<?php

namespace App\Presenters;

use App\Transformers\UjiPublikTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class UjiPublikPresenter
 *
 * @package namespace App\Presenters;
 */
class UjiPublikPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new UjiPublikTransformer();
    }
}
