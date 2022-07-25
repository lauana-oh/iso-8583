<?php

namespace Lauana\Iso\Types;

class NumericSpecialCharacter extends BaseType
{
    public function validate(string $value): bool
    {
        return ctype_digit(str_replace(SpecialCharacter::VALID_CHARACTERS, '', $value));
    }
}
