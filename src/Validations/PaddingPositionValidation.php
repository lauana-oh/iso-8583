<?php

namespace LauanaOh\Iso8583\Validations;

use Closure;
use LauanaOh\Iso8583\Contracts\ValidationContract;
use Symfony\Component\OptionsResolver\Exception\InvalidOptionsException;

class PaddingPositionValidation implements ValidationContract
{
    public function createIsValidCallable(): Closure
    {
        return static function ($value) {
            if (in_array($value, [STR_PAD_LEFT, STR_PAD_RIGHT], true)) {
                return true;
            }

            throw new InvalidOptionsException(
                sprintf(
                    'The option "fields[padding][position]" with value "%s" is invalid. Accepted values are: STR_PAD_LEFT (0), STR_PAD_RIGHT (1).',
                    $value
                )
            );
        };
    }
}