<?php

namespace LauanaOh\Iso8583\Types;

use LauanaOh\Iso8583\Constants\Types;

class AlphaNumericSpecialCharacter extends BaseType
{
    protected const TYPE = Types::TYPE_ALPHANUMERIC_SPECIAL_CHAR;

    public function isValid(string $value): bool
    {
        return true;
    }
}
