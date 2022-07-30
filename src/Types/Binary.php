<?php

namespace LauanaOh\Iso8583\Types;

class Binary extends BaseType
{
    public function validate(string $value): bool
    {
        return empty(str_replace(['0', '1'], '', $value));
    }
}
