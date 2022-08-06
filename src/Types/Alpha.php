<?php

namespace LauanaOh\Iso8583\Types;

use LauanaOh\Iso8583\Constants\FieldType;

class Alpha extends BaseType
{
    protected const TYPE = FieldType::TYPE_ALPHA;

    public function isValid(string $value): bool
    {
        return ctype_alpha(str_replace(' ', '', $value));
    }
}
