<?php

namespace Tests\Concerns;

use LauanaOh\Iso8583\Constants\Encodes;
use LauanaOh\Iso8583\Constants\Lengths;
use LauanaOh\Iso8583\Constants\Types;
use LauanaOh\Iso8583\Encoders\ASCII;
use LauanaOh\Iso8583\Encoders\BCD;
use LauanaOh\Iso8583\Lengths\Fixed;
use LauanaOh\Iso8583\Lengths\LLLVAR;
use LauanaOh\Iso8583\Lengths\LLVAR;
use LauanaOh\Iso8583\Types\Alpha;
use LauanaOh\Iso8583\Types\AlphaNumeric;
use LauanaOh\Iso8583\Types\AlphaNumericSpecialCharacter;
use LauanaOh\Iso8583\Types\AlphaSpecialCharacter;
use LauanaOh\Iso8583\Types\Binary;
use LauanaOh\Iso8583\Types\Numeric;
use LauanaOh\Iso8583\Types\NumericSpecialCharacter;
use LauanaOh\Iso8583\Types\SpecialCharacter;

trait HasContainerDataProvider
{
    public function dataTypes(): array
    {
        return [
            Types::TYPE_BINARY => [
                Types::TYPE_BINARY,
                Binary::class,
            ],
            Types::TYPE_ALPHA => [
                Types::TYPE_ALPHA,
                Alpha::class,
            ],
            Types::TYPE_ALPHANUMERIC => [
                Types::TYPE_ALPHANUMERIC,
                AlphaNumeric::class,
            ],
            Types::TYPE_NUMERIC => [
                Types::TYPE_NUMERIC,
                Numeric::class,
            ],
            Types::TYPE_SPECIAL_CHAR => [
                Types::TYPE_SPECIAL_CHAR,
                SpecialCharacter::class,
            ],
            Types::TYPE_NUMERIC_SPECIAL_CHAR => [
                Types::TYPE_NUMERIC_SPECIAL_CHAR,
                NumericSpecialCharacter::class,
            ],
            Types::TYPE_ALPHA_SPECIAL_CHAR => [
                Types::TYPE_ALPHA_SPECIAL_CHAR,
                AlphaSpecialCharacter::class,
            ],
            Types::TYPE_ALPHANUMERIC_SPECIAL_CHAR => [
                Types::TYPE_ALPHANUMERIC_SPECIAL_CHAR,
                AlphaNumericSpecialCharacter::class,
            ],
        ];
    }

    public function lengths(): array
    {
        return [
            'fixed' => [
                Lengths::TYPE_FIXED,
                Fixed::class,
            ],
            'llvar' => [
                Lengths::TYPE_LLVAR,
                LLVAR::class,
            ],
            'lllvar' => [
                Lengths::TYPE_LLLVAR,
                LLLVAR::class,
            ],
        ];
    }

    public function encoders(): array
    {
        return [
            Encodes::TYPE_BCD => [
                Encodes::TYPE_BCD,
                BCD::class,
            ],
            Encodes::TYPE_ASCII => [
                Encodes::TYPE_ASCII,
                ASCII::class,
            ],
        ];
    }
}