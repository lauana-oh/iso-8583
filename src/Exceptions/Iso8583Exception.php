<?php

namespace LauanaOh\Iso8583\Exceptions;

use Exception;

class Iso8583Exception extends Exception
{
    public static function invalidField(string $type, string $field, \Throwable $e): self
    {
        return new static(sprintf('[%s %s]%s', ucfirst($type), $field, $e->getMessage()), $e->getCode(), $e);
    }
}
