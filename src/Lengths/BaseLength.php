<?php

namespace Lauana\Iso\Lengths;

abstract class BaseLength
{
    protected string $encode;
    protected int $size;

    public function __construct(string $encode, int $size)
    {
        $this->encode = $encode;
        $this->size = $size;
    }
}