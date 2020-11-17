<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Anamnese;

/**
 * Class AnamneseTransformer.
 *
 * @package namespace App\Transformers;
 */
class AnamneseTransformer extends TransformerAbstract
{
    /**
     * Transform the Anamnese entity.
     *
     * @param \App\Entities\Anamnese $model
     *
     * @return array
     */
    public function transform(Anamnese $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
