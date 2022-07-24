<?php

namespace Lauana\Iso\Constants;

use Lauana\Iso\Contracts\TypeContract;
use Lauana\Iso\Types\Numeric;

class Types
{
    public const TYPE_NUMERIC = 'n';

    public const SUPPORTED_TYPES = [
        self::TYPE_NUMERIC,
    ];

    protected const TYPES_CLASSES = [
        self::TYPE_NUMERIC => Numeric::class,
    ];

    public static function getTypeNewClass(string $type): TypeContract
    {
        $class = self::TYPES_CLASSES[$type] ?? null;

        if (! $class) {
            throw new \Exception();
        }

        return new $class;
    }
}
