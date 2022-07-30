<?php

namespace Lauana\Iso\Tags;

use Lauana\Iso\Entities\ByteStream;
use Lauana\Iso\Entities\DataHolder;

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
