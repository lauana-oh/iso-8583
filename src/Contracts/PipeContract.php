<?php

namespace LauanaOh\Iso8583\Contracts;

use Closure;
use LauanaOh\Iso8583\Entities\ByteStream;
use LauanaOh\Iso8583\Entities\DataHolder;

interface PipeContract
{
    public function pack(DataHolder $data, ByteStream $message, Closure $next);

    public function unpack(DataHolder $data, ByteStream $message, Closure $next);
}
