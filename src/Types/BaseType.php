<?php

namespace LauanaOh\Iso8583\Types;

use Closure;
use LauanaOh\Iso8583\Contracts\TypeContract;
use LauanaOh\Iso8583\Entities\ByteStream;
use LauanaOh\Iso8583\Entities\DataHolder;
use LauanaOh\Iso8583\Exceptions\InvalidValueException;
use LauanaOh\Iso8583\Traits\HasEncoder;

abstract class BaseType implements TypeContract
{
    use HasEncoder;

    protected const TYPE = '';

    public function pack(DataHolder $data, ByteStream $message, Closure $next)
    {
        $value = $data->getField('value');
        $padding = $data->getField('padding');
        $encodedValue = $this->encoder->encode($value, $data->getField('padding'));

        $valueSize = is_string($value) && $padding->isForced()
            ? strlen($value)
            : $this->encoder->getSize(strlen($encodedValue));

        $data->setField('valueSize', $valueSize);

        $message->concat($encodedValue);

        return $next($data, $message);
    }

    public function unpack(DataHolder $data, ByteStream $message, Closure $next)
    {
        $padding = $data->getField('padding');
        $padding->setSize($data->getField('length'));

        $value = $this->encoder->decode(
            $message->getAndMoveCursor($this->encoder->getDigits($data->getField('length'))),
            $padding
        );

        $data->setField('value', $value);
        $data->setField('valueSize', strlen($value));

        return $next($data, $message);
    }

    public function validate(DataHolder $data, ByteStream $message, Closure $next)
    {
        $value = $data->getField('value');

        if (! $this->isValid($value)) {
            throw InvalidValueException::invalidType($value, static::TYPE);
        }

        return $next($data, $message);
    }

    abstract protected function isValid(string $value): bool;
}
