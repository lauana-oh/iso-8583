<?php

namespace LauanaOh\Iso8583\Lengths;

use Closure;
use LauanaOh\Iso8583\Entities\ByteStream;
use LauanaOh\Iso8583\Entities\DataHolder;

class Lllvar extends BaseLength
{
    public function pack(DataHolder $data, ByteStream $message, Closure $next)
    {
        $length = str_pad(strlen($data->getField('value')), 3, '0', STR_PAD_LEFT);
        $message->concat($this->encoder->encode($length));

        return $next($data, $message);
    }

    public function unpack(DataHolder $data, ByteStream $message, Closure $next)
    {
        $length = $this->encoder->decode($message->getAndMoveCursor($this->encoder->getDigits(3)));
        $data->setField('length', $length);

        return $next($data, $message);
    }

    public function validate(DataHolder $data, ByteStream $message, Closure $next)
    {
        return $next($data, $message);
    }
}
