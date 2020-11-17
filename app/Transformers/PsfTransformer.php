<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Psf;

/**
 * Class PsfTransformer.
 *
 * @package namespace App\Transformers;
 */
class PsfTransformer extends TransformerAbstract
{
    /**
     * Transform the Psf entity.
     *
     * @param \App\Entities\Psf $model
     *
     * @return array
     */
    public function transform(Psf $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
