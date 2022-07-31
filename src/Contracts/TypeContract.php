<?php

namespace LauanaOh\Iso8583\Contracts;

interface TypeContract extends PipeContract
{
    public function setEncoder(EncoderContract $encoder): self;
}
