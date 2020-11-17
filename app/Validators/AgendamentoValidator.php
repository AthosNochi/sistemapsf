<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class AgendamentoValidator.
 *
 * @package namespace App\Validators;
 */
class AgendamentoValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'descricao' => 'required|min:5',
            'datahora' => 'required',
            'patient_id' => 'required',
            'doctor_id' => 'required', 
            'secretaria_id' => 'required', 
            'legenda' => 'required',
        ],

        ValidatorInterface::RULE_UPDATE => [],
    ];
}
