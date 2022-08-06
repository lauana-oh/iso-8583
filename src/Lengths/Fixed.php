<?php

namespace LauanaOh\Iso8583\Lengths;

use Closure;
use LauanaOh\Iso8583\Entities\ByteStream;
use LauanaOh\Iso8583\Entities\DataHolder;
use LauanaOh\Iso8583\Exceptions\InvalidValueException;

class Fixed extends BaseLength
{
    public function pack(DataHolder $data, ByteStream $message, Closure $next)
    {
        return $next($data, $message);
    }

    public function unpack(DataHolder $data, ByteStream $message, Closure $next)
    {
        $data->setField('length', $this->size);

        return $next($data, $message);
    }

    public function validate(DataHolder $data, ByteStream $message, Closure $next)
    {
        $value = $data->getField('value');
        $valueSize = $data->getField('valueSize');

        if ($valueSize !== $this->size) {
            throw InvalidValueException::invalidFixedLength($value, $this->size);
        }

        return $next($data, $message);
    }
}
