<?php

namespace LauanaOh\Iso8583\Types;

use LauanaOh\Iso8583\Constants\Types;

class NumericSpecialCharacter extends BaseType
{
    protected const TYPE = Types::TYPE_NUMERIC_SPECIAL_CHAR;

    public function isValid(string $value): bool
    {
        return ctype_digit(str_replace(SpecialCharacter::VALID_CHARACTERS, '', $value));
    }
}
