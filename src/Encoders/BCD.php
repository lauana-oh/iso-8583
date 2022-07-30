<?php

namespace Lauana\Iso\Encoders;

use Lauana\Iso\Contracts\EncoderContract;
use Lauana\Iso\Contracts\PaddingContract;
use Lauana\Iso\Helpers\ContainerHelper;

class BCD implements EncoderContract
{
    public function encode(string $data, PaddingContract $padding = null): string
    {
        $padding ??= ContainerHelper::getNewPadding();

        if (strlen($data) % 2 !== 0) {
            $padding->setSize(strlen($data) + 1);
        }

        return $padding->pad($data);
    }

    public function decode(string $data, PaddingContract $padding = null): string
    {
        $padding ??= ContainerHelper::getNewPadding();

        return $padding->trim($data);
    }

    public function getSize(int $length): int
    {
        return $length;
    }

    public function getDigits(int $length): int
    {
        return $length % 2 === 0 ? $length : ++$length;
    }
}
