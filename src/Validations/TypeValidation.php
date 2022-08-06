<?php

namespace LauanaOh\Iso8583\Validations;

use Closure;
use LauanaOh\Iso8583\Contracts\ValidationContract;
use LauanaOh\Iso8583\Helpers\ContainerHelper;

class TypeValidation implements ValidationContract
{
    public function createCallable(): Closure
    {
        return static function ($value) {
            $type = str_replace('.', '', $value, $length);

            return ContainerHelper::isDefined('type_'.$type)
                && ContainerHelper::isDefined('length_'.$length);
        };
    }
}
