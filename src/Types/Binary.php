<?php

namespace LauanaOh\Iso8583\Types;

use LauanaOh\Iso8583\Constants\Types;

class Binary extends BaseType
{
    protected const TYPE = Types::TYPE_BINARY;

    public function isValid(string $value): bool
    {
        return empty(str_replace(['0', '1'], '', $value));
    }
}
