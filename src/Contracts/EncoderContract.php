<?php

namespace Lauana\Iso\Contracts;

use Lauana\Iso\Entities\Padding;

interface EncoderContract
{
    public function encode(string $data, ?Padding $padding = null): string;

    public function decode(string $data, ?Padding $padding = null): string;

    public function getSize(int $length, ?Padding $padding = null): int;

    public function getDigits(int $length, ?Padding $padding = null): int;
}