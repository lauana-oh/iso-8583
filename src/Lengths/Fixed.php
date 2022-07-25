<?php

namespace Lauana\Iso\Lengths;

use Lauana\Iso\Entities\ByteStream;
use Lauana\Iso\Entities\DataHolder;

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
