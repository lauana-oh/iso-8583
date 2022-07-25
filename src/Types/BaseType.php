<?php

namespace Lauana\Iso\Types;

use Lauana\Iso\Contracts\PipeContract;
use Lauana\Iso\Entities\ByteStream;
use Lauana\Iso\Entities\DataHolder;
use Lauana\Iso\Traits\HasEncoder;

abstract class BaseType implements PipeContract
{
    use HasEncoder;

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
        $value = $this->encoder->decode(
            $message->getAndMoveCursor($this->encoder->getDigits($data->getField('length')))
        );

        $this->validate($value);
        $data->setField('value', $value);

        return $next($data, $message);
    }

    abstract public function validate(string $value): bool;
}