<?php

namespace Lauana\Iso\Encoders;

use Lauana\Iso\Contracts\EncoderContract;
use Lauana\Iso\Entities\Padding;

class BCD implements EncoderContract
{
    public function encode(string $data, Padding $padding = null): string
    {
        $size = strlen($data);

        if (!$padding) {
            $padding = new Padding();
        }

        if ($size % 2 !== 0) {
            $padding->setIsActive(true);
            $size++;
        }

        return $padding->pad($data, $size);
    }

    public function decode(string $data, Padding $padding = null): string
    {
        if (!$padding) {
            $padding = new Padding();
        }

        return $padding->unpad($data);
    }

    public function getSize(int $length, ?Padding $padding = null): int
    {
        return $length;
    }

    public function getDigits(int $length, ?Padding $padding = null): int
    {
        return $length;
    }
}