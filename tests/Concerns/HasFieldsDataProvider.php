<?php

namespace Tests\Concerns;

use LauanaOh\Iso8583\Constants\Types;

trait HasFieldsDataProvider
{
    public function dataType(): array
    {
        return [
            'Invalid '.Types::TYPE_ALPHA => [
                Types::TYPE_ALPHA,
            ],
            'Invalid '.Types::TYPE_ALPHANUMERIC => [
                Types::TYPE_ALPHANUMERIC,
            ],
            'Invalid '.Types::TYPE_NUMERIC => [
                Types::TYPE_NUMERIC,
            ],
            'Invalid '.Types::TYPE_SPECIAL_CHAR => [
                Types::TYPE_NUMERIC,
            ],
            'Invalid '.Types::TYPE_ALPHA_SPECIAL_CHAR => [
                Types::TYPE_NUMERIC,
            ],
            'Invalid '.Types::TYPE_NUMERIC_SPECIAL_CHAR => [
                Types::TYPE_NUMERIC,
            ],
        ];
    }
}
