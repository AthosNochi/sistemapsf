<?php

namespace App\Presenters;

use App\Transformers\SecretariaTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class SecretariaPresenter.
 *
 * @package namespace App\Presenters;
 */
class SecretariaPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new SecretariaTransformer();
    }
}
