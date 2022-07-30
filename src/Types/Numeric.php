<?php

namespace LauanaOh\Iso8583\Types;

class Numeric extends BaseType
{
    public function validate(string $value): bool
    {
        return ctype_digit($value);
    }
}
