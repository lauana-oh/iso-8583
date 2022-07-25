<?php

namespace Lauana\Iso\Encoders;

use Lauana\Iso\Contracts\EncoderContract;
use Lauana\Iso\Entities\Padding;

class ASCII implements EncoderContract
{
    public function encode(string $data, Padding $padding = null): string
    {
        return strtoupper(bin2hex($data));
    }

    public function decode(string $data, Padding $padding = null): string
    {
        return hex2bin($data);
    }

    public function getSize(int $length, ?Padding $padding = null): int
    {
        return $length / 2;
    }

    public function getDigits(int $length, ?Padding $padding = null): int
    {
        return $length * 2;
    }
}