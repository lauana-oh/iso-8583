<?php

namespace Lauana\Iso\Contracts;

interface BitmapContract extends PipeContract
{
    public function getKey(): string;
}