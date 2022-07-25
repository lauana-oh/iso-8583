<?php

namespace Lauana\Iso\Types;

class AlphaSpecialCharacter extends BaseType
{
    public function validate(string $value): bool
    {
        return ctype_alpha(str_replace(array_merge([' '], SpecialCharacter::VALID_CHARACTERS), '', $value));
    }
}
