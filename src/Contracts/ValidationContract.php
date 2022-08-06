<?php

namespace LauanaOh\Iso8583\Contracts;

use Closure;

interface ValidationContract
{
    public function createCallable(): Closure;
}
