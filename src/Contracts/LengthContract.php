<?php

namespace LauanaOh\Iso8583\Contracts;

interface LengthContract extends PipeContract
{
    public function setSize(int $size): self;

    public function setEncoder(EncoderContract $encoder): self;
}
