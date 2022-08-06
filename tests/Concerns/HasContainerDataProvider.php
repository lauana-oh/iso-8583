<?php

namespace Tests\Concerns;

use LauanaOh\Iso8583\Constants\Encode;
use LauanaOh\Iso8583\Constants\Length;
use LauanaOh\Iso8583\Constants\FieldType;
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
            FieldType::TYPE_BINARY => [
                FieldType::TYPE_BINARY,
                Binary::class,
            ],
            FieldType::TYPE_ALPHA => [
                FieldType::TYPE_ALPHA,
                Alpha::class,
            ],
            FieldType::TYPE_ALPHANUMERIC => [
                FieldType::TYPE_ALPHANUMERIC,
                AlphaNumeric::class,
            ],
            FieldType::TYPE_NUMERIC => [
                FieldType::TYPE_NUMERIC,
                Numeric::class,
            ],
            FieldType::TYPE_SPECIAL_CHAR => [
                FieldType::TYPE_SPECIAL_CHAR,
                SpecialCharacter::class,
            ],
            FieldType::TYPE_NUMERIC_SPECIAL_CHAR => [
                FieldType::TYPE_NUMERIC_SPECIAL_CHAR,
                NumericSpecialCharacter::class,
            ],
            FieldType::TYPE_ALPHA_SPECIAL_CHAR => [
                FieldType::TYPE_ALPHA_SPECIAL_CHAR,
                AlphaSpecialCharacter::class,
            ],
            FieldType::TYPE_ALPHANUMERIC_SPECIAL_CHAR => [
                FieldType::TYPE_ALPHANUMERIC_SPECIAL_CHAR,
                AlphaNumericSpecialCharacter::class,
            ],
        ];
    }

    public function lengths(): array
    {
        return [
            'fixed' => [
                Length::TYPE_FIXED,
                Fixed::class,
            ],
            'llvar' => [
                Length::TYPE_LLVAR,
                LLVAR::class,
            ],
            'lllvar' => [
                Length::TYPE_LLLVAR,
                LLLVAR::class,
            ],
        ];
    }

    public function encoders(): array
    {
        return [
            Encode::TYPE_BCD => [
                Encode::TYPE_BCD,
                BCD::class,
            ],
            Encode::TYPE_ASCII => [
                Encode::TYPE_ASCII,
                ASCII::class,
            ],
        ];
    }
}
