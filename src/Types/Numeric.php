<?php

namespace Lauana\Iso\Types;

use Lauana\Iso\Contracts\TypeContract;

class Numeric implements TypeContract
{
    public function validate(string $value): bool
    {
        return ctype_digit($value);
    }
}
