<?php

namespace LauanaOh\Iso8583\Types;

use LauanaOh\Iso8583\Constants\Types;

class Numeric extends BaseType
{
    protected const TYPE = Types::TYPE_NUMERIC;

    public function isValid(string $value): bool
    {
        return ctype_digit($value);
    }
}
