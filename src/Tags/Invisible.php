<?php

namespace LauanaOh\Iso8583\Tags;

use LauanaOh\Iso8583\Entities\ByteStream;
use LauanaOh\Iso8583\Entities\DataHolder;

class Invisible extends BaseTag
{
    public function pack(DataHolder $data, ByteStream $message, \Closure $next)
    {
        return $next($data, $message);
    }

    public function unpack(DataHolder $data, ByteStream $message, \Closure $next)
    {
        $data->setField('key', $this->getValue());

        return $next($data, $message);
    }
}
