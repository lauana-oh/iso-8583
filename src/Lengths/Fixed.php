<?php

namespace LauanaOh\Iso8583\Lengths;

use LauanaOh\Iso8583\Entities\ByteStream;
use LauanaOh\Iso8583\Entities\DataHolder;

class Fixed extends BaseLength
{
    public function pack(DataHolder $data, ByteStream $message, \Closure $next)
    {
        return $next($data, $message);
    }

    public function unpack(DataHolder $data, ByteStream $message, \Closure $next)
    {
        $data->setField('length', $this->size);

        return $next($data, $message);
    }
}
