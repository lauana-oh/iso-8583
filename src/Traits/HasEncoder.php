<?php

namespace LauanaOh\Iso8583\Traits;

use LauanaOh\Iso8583\Contracts\EncoderContract;

trait HasEncoder
{
    protected EncoderContract $encoder;

    public function setEncoder(EncoderContract $encoder): self
    {
        $this->encoder = $encoder;

        return $this;
    }
}
