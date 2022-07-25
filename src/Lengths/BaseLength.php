<?php

namespace Lauana\Iso\Lengths;

use Lauana\Iso\Contracts\PipeContract;
use Lauana\Iso\Traits\HasEncoder;

abstract class BaseLength implements PipeContract
{
    use HasEncoder;

    protected int $size;

    public function setSize(int $size): self
    {
        $this->size = $size;

        return $this;
    }
}
