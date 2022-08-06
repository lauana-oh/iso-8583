<?php

namespace LauanaOh\Iso8583\Constants;

class Tag
{
    public const TYPE_INVISIBLE = 'invisible';
    public const TYPE_VISIBLE = 'visible';

    public const POSITION_BEFORE = 'before';
    public const POSITION_AFTER = 'after';
    public const POSITION_NONE = 'none';

    public const AVAILABLE_POSITIONS = [
        self::POSITION_BEFORE,
        self::POSITION_AFTER,
        self::POSITION_NONE,
    ];
}
