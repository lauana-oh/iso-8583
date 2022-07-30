<?php

namespace LauanaOh\Iso8583\Entities;

use Closure;
use LauanaOh\Iso8583\Contracts\BitmapContract;

class Bitmap implements BitmapContract
{
    protected const FIELD_KEY = '1';

    public function getKey(): string
    {
        return self::FIELD_KEY;
    }

    public function pack(DataHolder $data, ByteStream $message, Closure $next)
    {
        $fieldsData = $data->toArray();
        unset($fieldsData['bitmap']);

        $fieldsPresent = array_filter(array_keys($fieldsData));

        $bits = $this->createBitsString(max($fieldsPresent));
        $this->fillInPresentFields($fieldsPresent, $bits);

        $message->concat(convert_bits_to_hex($bits));

        return $next($data, $message);
    }

    public function unpack(DataHolder $data, ByteStream $message, Closure $next)
    {
        $bits = $this->unpackBitmapBytesToBits($message);

        $data->setField('bitmap', $this->convertBitsToPresentFields($bits));

        return $next($data, $message);
    }

    protected function createBitsString($maxField): string
    {
        $size = 0;
        $bits = '';

        do {
            $size += 64;
            $bits .= $maxField > $size ? '1' : '0';
            $bits .= str_repeat('0', 63);
        } while ($maxField > $size);

        return $bits;
    }

    protected function fillInPresentFields(array $fieldsPresent, string &$bits): void
    {
        foreach ($fieldsPresent as $field) {
            $bits[$field - 1] = true;
        }
    }

    protected function unpackBitmapBytesToBits(ByteStream $message): string
    {
        $bits = '';

        do {
            $nextBitmap = false;
            $currentBits = convert_hex_to_bits($message->getAndMoveCursor(16));

            if ($currentBits[0] === '1') {
                $nextBitmap = true;
                $currentBits[0] = '0';
            }

            $bits .= $currentBits;
        } while ($nextBitmap);

        return $bits;
    }

    protected function convertBitsToPresentFields(string $bits): array
    {
        $positionsFilled = array_filter(str_split($bits));

        return array_map(function ($field) {
            return ++$field;
        }, array_keys($positionsFilled));
    }

    public function validate(DataHolder $data, ByteStream $message, Closure $next)
    {
        return $next($data, $message);
    }
}
