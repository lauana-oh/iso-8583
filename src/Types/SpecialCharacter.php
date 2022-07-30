<?php

namespace LauanaOh\Iso8583\Types;

class SpecialCharacter extends BaseType
{
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

    public function validate(string $value): bool
    {
        return empty(str_replace(self::VALID_CHARACTERS, '', $value));
    }
}
