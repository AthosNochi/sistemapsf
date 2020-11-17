<?php

namespace App\Presenters;

use App\Transformers\AvailabilityTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class AvailabilityPresenter.
 *
 * @package namespace App\Presenters;
 */
class AvailabilityPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new AvailabilityTransformer();
    }
}
