<?php

namespace LauanaOh\Iso8583\Encoders;

use LauanaOh\Iso8583\Contracts\EncoderContract;
use LauanaOh\Iso8583\Contracts\PaddingContract;

class ASCII implements EncoderContract
{
    public function encode(string $data, PaddingContract $padding = null): string
    {
        return strtoupper(bin2hex($data));
    }

    public function decode(string $data, PaddingContract $padding = null): string
    {
        return hex2bin($data);
    }

    public function getSize(int $length): int
    {
        return $length / 2;
    }

    public function getDigits(int $length): int
    {
        return $length * 2;
    }
}
