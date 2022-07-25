<?php

namespace Lauana\Iso\Lengths;

use Lauana\Iso\Entities\ByteStream;
use Lauana\Iso\Entities\DataHolder;

class Lllvar extends BaseLength
{
    public function pack(DataHolder $data, ByteStream $message, \Closure $next)
    {
        $length = str_pad(strlen($data->getField('value')), 3, '0', STR_PAD_LEFT);
        $message->concat($this->encoder->encode($length));

        return $next($data, $message);
    }

    public function unpack(DataHolder $data, ByteStream $message, \Closure $next)
    {
        $data->setField('length', $this->encoder->decode($message->getAndMoveCursor($this->encoder->getDigits(3))));

        return $next($data, $message);
    }
}
