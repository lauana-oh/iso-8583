<?php

namespace LauanaOh\Iso8583\Tags;

use Closure;
use LauanaOh\Iso8583\Contracts\TagContract;
use LauanaOh\Iso8583\Entities\ByteStream;
use LauanaOh\Iso8583\Entities\DataHolder;
use LauanaOh\Iso8583\Traits\HasEncoder;

abstract class BaseTag implements TagContract
{
    use HasEncoder;

    protected string $value;

    public function setValue(string $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function validate(DataHolder $data, ByteStream $message, Closure $next)
    {
        return $next($data, $message);
    }
}
