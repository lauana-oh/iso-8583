<?php

namespace Lauana\Iso\Contracts;

interface TypeContract
{
    public function validate(string $value): bool;
}
