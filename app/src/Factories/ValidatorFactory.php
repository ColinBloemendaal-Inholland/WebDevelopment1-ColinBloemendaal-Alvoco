<?php

namespace App\Factories;

use Rakit\Validation\Validator;

class ValidatorFactory
{
    public static function make()
    {
        return new Validator();
    }
}
