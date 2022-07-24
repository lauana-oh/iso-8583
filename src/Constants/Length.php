<?php

namespace Lauana\Iso\Constants;

use Lauana\Iso\Lengths\FixedLength;
use Lauana\Iso\Lengths\LlvarLength;

class Length
{
    public const TYPE_FIXED = 0;
    public const TYPE_LLVAR = 2;

    public const SUPPORTED_LENGTHS = [
        self::TYPE_FIXED,
        self::TYPE_LLVAR,
    ];

    protected const LENGTH_CLASSES = [
        self::TYPE_FIXED => FixedLength::class,
        self::TYPE_LLVAR => LlvarLength::class,
    ];

    public static function getLengthNewClass(string $type, string $encode, int $size)
    {
        $class = self::LENGTH_CLASSES[$type] ?? null;

        if (! $class) {
            throw new \Exception();
        }

        return new $class($encode, $size);
    }
}