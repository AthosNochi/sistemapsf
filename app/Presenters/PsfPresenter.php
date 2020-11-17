<?php

namespace App\Presenters;

use App\Transformers\PsfTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class PsfPresenter.
 *
 * @package namespace App\Presenters;
 */
class PsfPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new PsfTransformer();
    }
}
