<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Secretaria;

/**
 * Class SecretariaTransformer.
 *
 * @package namespace App\Transformers;
 */
class SecretariaTransformer extends TransformerAbstract
{
    /**
     * Transform the Secretaria entity.
     *
     * @param \App\Entities\Secretaria $model
     *
     * @return array
     */
    public function transform(Secretaria $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
