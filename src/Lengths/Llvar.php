<?php

namespace LauanaOh\Iso8583\Lengths;

use LauanaOh\Iso8583\Entities\ByteStream;
use LauanaOh\Iso8583\Entities\DataHolder;

class Llvar extends BaseLength
{
    public function pack(DataHolder $data, ByteStream $message, \Closure $next)
    {
        $length = str_pad(strlen($data->getField('value')), 2, '0', STR_PAD_LEFT);
        $message->concat($this->encoder->encode($length));

        return $next($data, $message);
    }

    public function unpack(DataHolder $data, ByteStream $message, \Closure $next)
    {
        $data->setField('length', $this->encoder->decode($message->getAndMoveCursor($this->encoder->getDigits(2))));

        return $next($data, $message);
    }
}
