<?php

namespace Lauana\Iso\Contracts;

use Closure;
use Lauana\Iso\Entities\ByteStream;
use Lauana\Iso\Entities\DataHolder;

interface PipeContract
{
    public function pack(DataHolder $data, ByteStream $message, Closure $next);

    public function unpack(DataHolder $data, ByteStream $message, Closure $next);
}