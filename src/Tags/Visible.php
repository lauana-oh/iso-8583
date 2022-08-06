<?php

namespace LauanaOh\Iso8583\Tags;

use Closure;
use LauanaOh\Iso8583\Entities\ByteStream;
use LauanaOh\Iso8583\Entities\DataHolder;
use LauanaOh\Iso8583\Traits\HasEncoder;

class Visible extends BaseTag
{
    use HasEncoder;

    protected int $size = 0;

    public function pack(DataHolder $data, ByteStream $message, Closure $next)
    {
        $message->prepend($this->encoder->encode($this->getValue()));

        return $next($data, $message);
    }

    public function unpack(DataHolder $data, ByteStream $message, Closure $next)
    {
        $data->setField('key', $this->encoder->decode(
            $message->getAndMoveCursor($this->encoder->getDigits($this->getSize()))
        ));

        return $next($data, $message);
    }

    protected function getSize(): int
    {
        return $this->size ?: strlen($this->getValue());
    }
}
