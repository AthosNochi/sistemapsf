<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class AnamneseValidator.
 *
 * @package namespace App\Validators;
 */
class AnamneseValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [],
        ValidatorInterface::RULE_UPDATE => [],
    ];
}
