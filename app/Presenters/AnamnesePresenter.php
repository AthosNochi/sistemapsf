<?php

namespace App\Presenters;

use App\Transformers\AnamneseTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class AnamnesePresenter.
 *
 * @package namespace App\Presenters;
 */
class AnamnesePresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new AnamneseTransformer();
    }
}
