<?php

namespace Tests\Concerns;

use LauanaOh\Iso8583\Constants\Length;
use LauanaOh\Iso8583\Constants\FieldType;

trait HasFieldsDataProvider
{
    public function dataType(): array
    {
        return [
            FieldType::TYPE_ALPHA => [
                FieldType::TYPE_ALPHA,
            ],
            FieldType::TYPE_ALPHANUMERIC => [
                FieldType::TYPE_ALPHANUMERIC,
            ],
            FieldType::TYPE_BINARY => [
                FieldType::TYPE_BINARY,
            ],
            FieldType::TYPE_NUMERIC => [
                FieldType::TYPE_NUMERIC,
            ],
            FieldType::TYPE_SPECIAL_CHAR => [
                FieldType::TYPE_SPECIAL_CHAR,
            ],
            FieldType::TYPE_ALPHA_SPECIAL_CHAR => [
                FieldType::TYPE_ALPHA_SPECIAL_CHAR,
            ],
            FieldType::TYPE_NUMERIC_SPECIAL_CHAR => [
                FieldType::TYPE_NUMERIC_SPECIAL_CHAR,
            ],
        ];
    }

    public function invalidFixedLength(): array
    {
        return [
            'shorter than length' => [
                Length::TYPE_FIXED,
                10,
                '[Field %s]: value "%s" must have length equals to 10.',
            ],
            'larger than length' => [
                Length::TYPE_FIXED,
                6,
                '[Field %s]: value "%s" must have length equals to 6.',
            ],
        ];
    }

    public function invalidVariableLength(): array
    {
        return [
            'larger than llvar length' => [
                Length::TYPE_LLVAR,
                6,
                '[Field %s]: value "%s" length must not be greater than 6.',
            ],
            'larger than lllvar length' => [
                Length::TYPE_LLLVAR,
                6,
                '[Field %s]: value "%s" length must not be greater than 6.',
            ],
        ];
    }
}
