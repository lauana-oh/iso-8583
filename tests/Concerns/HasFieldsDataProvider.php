<?php

namespace Tests\Concerns;

use LauanaOh\Iso8583\Constants\Lengths;
use LauanaOh\Iso8583\Constants\Types;

trait HasFieldsDataProvider
{
    public function dataType(): array
    {
        return [
            Types::TYPE_ALPHA => [
                Types::TYPE_ALPHA,
            ],
            Types::TYPE_ALPHANUMERIC => [
                Types::TYPE_ALPHANUMERIC,
            ],
            Types::TYPE_BINARY => [
                Types::TYPE_BINARY,
            ],
            Types::TYPE_NUMERIC => [
                Types::TYPE_NUMERIC,
            ],
            Types::TYPE_SPECIAL_CHAR => [
                Types::TYPE_SPECIAL_CHAR,
            ],
            Types::TYPE_ALPHA_SPECIAL_CHAR => [
                Types::TYPE_ALPHA_SPECIAL_CHAR,
            ],
            Types::TYPE_NUMERIC_SPECIAL_CHAR => [
                Types::TYPE_NUMERIC_SPECIAL_CHAR,
            ],
        ];
    }

    public function invalidFixedLength(): array
    {
        return [
            'shorter than length' => [
                Lengths::TYPE_FIXED,
                10,
                '[Field %s]: value "%s" must have length equals to 10.',
            ],
            'larger than length' => [
                Lengths::TYPE_FIXED,
                6,
                '[Field %s]: value "%s" must have length equals to 6.',
            ],
        ];
    }

    public function invalidVariableLength(): array
    {
        return [
            'larger than llvar length' => [
                Lengths::TYPE_LLVAR,
                6,
                '[Field %s]: value "%s" length must not be greater than 6.',
            ],
            'larger than lllvar length' => [
                Lengths::TYPE_LLLVAR,
                6,
                '[Field %s]: value "%s" length must not be greater than 6.',
            ],
        ];
    }
}
