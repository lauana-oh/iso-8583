<?php

namespace LauanaOh\Iso8583\Validations;

use Closure;
use LauanaOh\Iso8583\Contracts\FieldBuilderContract;
use LauanaOh\Iso8583\Contracts\ValidationContract;

class BuilderValidation implements ValidationContract
{
    public function createCallable(): Closure
    {
        return static function ($value) {
            if (!in_array(FieldBuilderContract::class, class_implements($value), true)) {
                throw new \Exception();
            }

            return true;
        };
    }
}