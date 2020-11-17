<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Enfermeiro;

/**
 * Class EnfermeiroTransformer.
 *
 * @package namespace App\Transformers;
 */
class EnfermeiroTransformer extends TransformerAbstract
{
    /**
     * Transform the Enfermeiro entity.
     *
     * @param \App\Entities\Enfermeiro $model
     *
     * @return array
     */
    public function transform(Enfermeiro $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
