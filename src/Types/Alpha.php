<?php

namespace Lauana\Iso\Types;

class Alpha extends BaseType
{
    public function validate(string $value): bool
    {
        return ctype_alpha(str_replace(' ', '', $value));
    }
}
