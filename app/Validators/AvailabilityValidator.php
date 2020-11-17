<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class AvailabilityValidator.
 *
 * @package namespace App\Validators;
 */
class AvailabilityValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'id_medico'   => 'required', 
            'consulta'   => 'required', 
            'disponibilidade'  => '', 
            'adicoes' => '',
            'exclusoes'    => ''
        ],

        ValidatorInterface::RULE_UPDATE => [],
    ];
}
