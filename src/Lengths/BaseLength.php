<?php

namespace LauanaOh\Iso8583\Lengths;

use LauanaOh\Iso8583\Contracts\LengthContract;
use LauanaOh\Iso8583\Traits\HasEncoder;

abstract class BaseLength implements LengthContract
{
    use HasEncoder;

    protected int $size;

    public function setSize(int $size): self
    {
        $this->size = $size;

        return $this;
    }
}
