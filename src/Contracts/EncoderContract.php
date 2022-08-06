<?php

namespace LauanaOh\Iso8583\Contracts;

interface EncoderContract
{
    public function encode(string $data, ?PaddingContract $padding = null): string;

    public function decode(string $data, ?PaddingContract $padding = null): string;

    public function getDigits(int $length): int;

    public function getSize(int $length): int;
}
