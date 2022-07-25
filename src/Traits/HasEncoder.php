<?php

namespace Lauana\Iso\Traits;

use Lauana\Iso\Contracts\EncoderContract;

trait HasEncoder
{
    protected EncoderContract $encoder;

    public function setEncoder(EncoderContract $encoder): self
    {
        $this->encoder = $encoder;

        return $this;
    }
}