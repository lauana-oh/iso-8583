<?php

namespace LauanaOh\Iso8583\Types;

use LauanaOh\Iso8583\Constants\FieldType;

class AlphaSpecialCharacter extends BaseType
{
    protected const TYPE = FieldType::TYPE_ALPHA_SPECIAL_CHAR;

    public function isValid(string $value): bool
    {
        return ctype_alpha(str_replace(array_merge([' '], SpecialCharacter::VALID_CHARACTERS), '', $value));
    }
}
