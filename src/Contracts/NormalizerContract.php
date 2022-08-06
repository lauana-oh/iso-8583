<?php

namespace LauanaOh\Iso8583\Contracts;

use Closure;

interface NormalizerContract
{
    public function createCallable(): Closure;
}