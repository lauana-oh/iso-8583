<?php

namespace Lauana\Iso\Contracts;

interface EncoderContract
{
    public function encode(string $data, ?PaddingContract $padding = null): string;

    public function decode(string $data, ?PaddingContract $padding = null): string;

    public function getSize(int $length): int;

    public function getDigits(int $length): int;
}
