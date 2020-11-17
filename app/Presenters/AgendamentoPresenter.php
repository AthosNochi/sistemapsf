<?php

namespace App\Presenters;

use App\Transformers\AgendamentoTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class AgendamentoPresenter.
 *
 * @package namespace App\Presenters;
 */
class AgendamentoPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new AgendamentoTransformer();
    }
}
