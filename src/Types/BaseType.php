<?php

namespace LauanaOh\Iso8583\Types;

use LauanaOh\Iso8583\Contracts\PipeContract;
use LauanaOh\Iso8583\Entities\ByteStream;
use LauanaOh\Iso8583\Entities\DataHolder;
use LauanaOh\Iso8583\Exceptions\InvalidValueException;
use LauanaOh\Iso8583\Traits\HasEncoder;

abstract class BaseType implements PipeContract
{
    use HasEncoder;

    protected const TYPE = '';

    public function pack(DataHolder $data, ByteStream $message, \Closure $next)
    {
        $this->validate($data->getField('value'));

        $message->concat($this->encoder->encode(
            $data->getField('value'),
            $data->getField('padding'),
        ));

        return $next($data, $message);
    }

    public function unpack(DataHolder $data, ByteStream $message, \Closure $next)
    {
        $padding = $data->getField('padding');
        $padding->setSize($data->getField('length'));

        $value = $this->encoder->decode(
            $message->getAndMoveCursor($this->encoder->getDigits($data->getField('length'))),
            $padding
        );

        $this->validate($value);
        $data->setField('value', $value);

        return $next($data, $message);
    }

    protected function validate(string $value)
    {
        if (!$this->isValid($value)) {
            throw InvalidValueException::invalidType($value, static::TYPE);
        }
    }

    abstract protected function isValid(string $value): bool;
}
