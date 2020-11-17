<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class UserValidator.
 *
 * @package namespace App\Validators;
 */
class UserValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            // 'cpf'   => ['required', 'int', 'max:11'],
            // 'name' => ['required', 'string', 'max:255'], 
            // 'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            // 'password' => ['required', 'string', 'min:8', 'confirmed'],
            // 'phone' => ['required', 'int', 'max:10'],
            // 'rg'    => ['required', 'int', 'max:8'],
            
        ],
        ValidatorInterface::RULE_UPDATE => [],
    ];
}
