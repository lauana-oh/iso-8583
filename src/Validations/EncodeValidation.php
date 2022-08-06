<?php

namespace LauanaOh\Iso8583\Validations;

use Closure;
use LauanaOh\Iso8583\Contracts\ValidationContract;
use LauanaOh\Iso8583\Helpers\ContainerHelper;

class EncodeValidation implements ValidationContract
{
    public function createCallable(): Closure
    {
        return static function ($encodes) {
            return empty(array_filter(
                $encodes,
                fn ($value) => ! ContainerHelper::isDefined('encoder_'.$value)
            ));
        };
    }
}