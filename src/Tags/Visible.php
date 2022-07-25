<?php

namespace Lauana\Iso\Tags;

use Lauana\Iso\Entities\ByteStream;
use Lauana\Iso\Entities\DataHolder;
use Lauana\Iso\Traits\HasEncoder;

class Visible extends BaseTag
{
    use HasEncoder;

    protected int $size = 0;

    public function pack(DataHolder $data, ByteStream $message, \Closure $next)
    {
        $message->concat($this->encoder->encode($this->getValue()));

        return $next($data, $message);
    }

    public function unpack(DataHolder $data, ByteStream $message, \Closure $next)
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