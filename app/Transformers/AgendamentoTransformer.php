<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Agendamento;

/**
 * Class AgendamentoTransformer.
 *
 * @package namespace App\Transformers;
 */
class AgendamentoTransformer extends TransformerAbstract
{
    /**
     * Transform the Agendamento entity.
     *
     * @param \App\Entities\Agendamento $model
     *
     * @return array
     */
    public function transform(Agendamento $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
