<?php

namespace App\Presenters;

use App\Transformers\EnfermeiroTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class EnfermeiroPresenter.
 *
 * @package namespace App\Presenters;
 */
class EnfermeiroPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new EnfermeiroTransformer();
    }
}
