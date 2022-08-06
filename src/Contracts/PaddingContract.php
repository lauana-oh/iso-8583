<?php

namespace LauanaOh\Iso8583\Contracts;

use LauanaOh\Iso8583\Entities\Padding;

interface PaddingContract
{
    public function pad(string $value): string;

    public function trim(string $value): string;

    public function setPadString(?string $padString): self;

    public function setPosition(?int $position): Padding;

    public function setSize(int $size = 0): Padding;

    public function getSize(): int;

    public function setForced(bool $forced): Padding;

    public function isForced(): bool;
}
