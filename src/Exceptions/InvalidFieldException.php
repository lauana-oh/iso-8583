<?php

namespace LauanaOh\Iso8583\Exceptions;

class InvalidFieldException extends Iso8583Exception
{
    public static function undefinedField(string $field): self
    {
        return new self(sprintf('[Field %s]: Field has no specification set', $field));
    }
}