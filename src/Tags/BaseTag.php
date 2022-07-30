<?php

namespace LauanaOh\Iso8583\Tags;

use LauanaOh\Iso8583\Contracts\PipeContract;

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
}
