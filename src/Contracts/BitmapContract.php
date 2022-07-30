<?php

namespace LauanaOh\Iso8583\Contracts;

interface BitmapContract extends PipeContract
{
    public function getKey(): string;
}
