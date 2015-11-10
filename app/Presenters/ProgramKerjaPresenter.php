<?php

namespace App\Presenters;

use App\Transformers\ProgramKerjaTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class ProgramKerjaPresenter
 *
 * @package namespace App\Presenters;
 */
class ProgramKerjaPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ProgramKerjaTransformer();
    }
}
