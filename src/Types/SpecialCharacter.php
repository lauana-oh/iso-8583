<?php

namespace LauanaOh\Iso8583\Types;

use LauanaOh\Iso8583\Constants\Types;

class SpecialCharacter extends BaseType
{
    protected const TYPE = Types::TYPE_SPECIAL_CHAR;

    public const VALID_CHARACTERS = [
        '!',
        '”',
        '#',
        '$',
        '%',
        '&',
        '’',
        '(',
        ')',
        '*',
        '+',
        ',',
        '-',
        '.',
        '/',
        ':',
        ';',
        '<',
        '=',
        '>',
        '?',
        '@',
        '[',
        '\\',
        ']',
        '^',
        '_',
        '`',
        '{',
        '|',
        '}',
        '~',
    ];

    public function isValid(string $value): bool
    {
        return empty(str_replace(self::VALID_CHARACTERS, '', $value));
    }
}
