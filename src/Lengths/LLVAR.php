<?php

namespace LauanaOh\Iso8583\Lengths;

use Closure;
use LauanaOh\Iso8583\Entities\ByteStream;
use LauanaOh\Iso8583\Entities\DataHolder;
use LauanaOh\Iso8583\Exceptions\InvalidValueException;

class LLVAR extends BaseLength
{
    protected const LENGTH = 2;

    public function pack(DataHolder $data, ByteStream $message, Closure $next)
    {
        $length = str_pad($data->getField('valueSize'), static::LENGTH, '0', STR_PAD_LEFT);
        $message->prepend($this->encoder->encode($length));

        return $next($data, $message);
    }

    public function unpack(DataHolder $data, ByteStream $message, Closure $next)
    {
        $data->setField('length', $this->encoder->decode($message->getAndMoveCursor($this->encoder->getDigits(static::LENGTH))));

        return $next($data, $message);
    }

    public function validate(DataHolder $data, ByteStream $message, Closure $next)
    {
        $value = $data->getField('value');
        $valueSize = $data->getField('valueSize');

        if ($valueSize > $this->size) {
            throw InvalidValueException::invalidVariableLength($value, $this->size);
        }

        return $next($data, $message);
    }
}
