<?php

namespace LauanaOh\Iso8583\Exceptions;

use LauanaOh\Iso8583\Contracts\EncoderContract;
use LauanaOh\Iso8583\Contracts\LengthContract;
use LauanaOh\Iso8583\Contracts\TypeContract;

class ContainerException extends Iso8583Exception
{
    public static function invalidType(string $type, string $implementation): self
    {
        return new self(sprintf(
            'Error setting type "%s": The class "%s" does not implement %s interface.',
            $type,
            $implementation,
            TypeContract::class
        ));
    }

    public static function invalidEncoder(string $type, string $implementation): self
    {
        return new self(sprintf(
            'Error setting encoder "%s": The class "%s" does not implement %s interface.',
            $type,
            $implementation,
            EncoderContract::class
        ));
    }

    public static function invalidLength(string $type, string $implementation): self
    {
        return new self(sprintf(
            'Error setting length "%s": The class "%s" does not implement %s interface.',
            $type,
            $implementation,
            LengthContract::class
        ));
    }
}