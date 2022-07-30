<?php

namespace LauanaOh\Iso8583\Types;

class AlphaNumericSpecialCharacter extends BaseType
{
    public function validate(string $value): bool
    {
        return true;
    }
}
