<?php

namespace Lauana\Iso\Encoders;

use Lauana\Iso\Contracts\EncoderContract;
use Lauana\Iso\Entities\Padding;
use Lauana\Iso\Helpers\ContainerHelper;

class BCD implements EncoderContract
{
    public function encode(string $data, Padding $padding = null): string
    {
        $size = strlen($data);
        $padding ??= ContainerHelper::getNewPadding();

        if ($size % 2 !== 0) {
            $padding->setSize(++$size);
        }

        return $padding->pad($data);
    }

    public function decode(string $data, Padding $padding = null): string
    {
        $padding ??= ContainerHelper::getNewPadding();

        return $padding->unpad($data);
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
