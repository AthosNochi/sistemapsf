<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Availability;

/**
 * Class AvailabilityTransformer.
 *
 * @package namespace App\Transformers;
 */
class AvailabilityTransformer extends TransformerAbstract
{
    /**
     * Transform the Availability entity.
     *
     * @param \App\Entities\Availability $model
     *
     * @return array
     */
    public function transform(Availability $model)
    {
        return [
            'id'         => (int) $model->id,

            'disponibilidade' => json_encode($model->disponibilidade),

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
