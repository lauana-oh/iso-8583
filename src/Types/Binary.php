<?php

namespace Lauana\Iso\Types;

class Binary extends BaseType
{
    public function validate(string $value): bool
    {
        return empty(str_replace(['0', '1'], '', $value));
    }
}
