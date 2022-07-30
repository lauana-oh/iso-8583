<?php

namespace LauanaOh\Iso8583\Exceptions;

class InvalidValueException extends Iso8583Exception
{
    public static function invalidType(string $value, string $type): self
    {
        return new self(sprintf(': value "%s" is not valid type "%s".', $value, $type));
    }

    public static function invalidField(string $type, string $field, \Throwable $e): self
    {
        return new self(sprintf('[%s %s]%s', ucfirst($type), $field, $e->getMessage()), $e->getCode(), $e);
    }
}