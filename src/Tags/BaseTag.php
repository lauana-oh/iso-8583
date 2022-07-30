<?php

namespace LauanaOh\Iso8583\Tags;

use Closure;
use LauanaOh\Iso8583\Contracts\PipeContract;
use LauanaOh\Iso8583\Entities\ByteStream;
use LauanaOh\Iso8583\Entities\DataHolder;

abstract class BaseTag implements PipeContract
{
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
