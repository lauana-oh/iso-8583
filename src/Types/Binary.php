<?php

namespace LauanaOh\Iso8583\Types;

use LauanaOh\Iso8583\Constants\FieldType;

class Binary extends BaseType
{
    protected const TYPE = FieldType::TYPE_BINARY;

    public function isValid(string $value): bool
    {
        return empty(str_replace(['0', '1'], '', $value));
    }
}
