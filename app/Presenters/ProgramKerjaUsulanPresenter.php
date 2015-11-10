<?php

namespace App\Presenters;

use App\Transformers\ProgramKerjaUsulanTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class ProgramKerjaUsulanPresenter
 *
 * @package namespace App\Presenters;
 */
class ProgramKerjaUsulanPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ProgramKerjaUsulanTransformer();
    }
}
