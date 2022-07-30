<?php

namespace LauanaOh\Iso8583\Types;

class NumericSpecialCharacter extends BaseType
{
    public function validate(string $value): bool
    {
        return ctype_digit(str_replace(SpecialCharacter::VALID_CHARACTERS, '', $value));
    }
}
