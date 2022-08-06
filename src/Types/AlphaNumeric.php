<?php

namespace LauanaOh\Iso8583\Types;

use LauanaOh\Iso8583\Constants\FieldType;

class AlphaNumeric extends BaseType
{
    protected const TYPE = FieldType::TYPE_ALPHANUMERIC;

    public function isValid(string $value): bool
    {
        return ctype_alnum(str_replace(' ', '', $value));
    }
}
