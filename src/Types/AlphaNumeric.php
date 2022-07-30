<?php

namespace LauanaOh\Iso8583\Types;

class AlphaNumeric extends BaseType
{
    public function validate(string $value): bool
    {
        return ctype_alnum(str_replace(' ', '', $value));
    }
}
