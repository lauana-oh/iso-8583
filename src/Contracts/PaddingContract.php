<?php

namespace Lauana\Iso\Contracts;

use Lauana\Iso\Entities\Padding;

interface PaddingContract
{
    public function pad(string $value): string;

    public function trim(string $value): string;

    public function setPadString(?string $padString): PaddingContract;

    public function setPosition(?int $position): Padding;

    public function setSize(int $size = 0): Padding;
}