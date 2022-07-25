<?php

namespace Lauana\Iso\Types;

class AlphaNumericSpecialCharacter extends BaseType
{
    public function validate(string $value): bool
    {
        return true;
    }
}
