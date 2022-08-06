<?php

namespace LauanaOh\Iso8583\Types;

use LauanaOh\Iso8583\Constants\FieldType;

class AlphaNumericSpecialCharacter extends BaseType
{
    protected const TYPE = FieldType::TYPE_ALPHANUMERIC_SPECIAL_CHAR;

    public function isValid(string $value): bool
    {
        return true;
    }
}
