<?php

namespace LauanaOh\Iso8583\Entities;

use LauanaOh\Iso8583\Contracts\PaddingContract;

class Padding implements PaddingContract
{
    public const DEFAULT_PAD_STRING = '0';
    public const DEFAULT_POSITION = STR_PAD_LEFT;

    protected string $padString = self::DEFAULT_PAD_STRING;
    protected int $position = self::DEFAULT_POSITION;
    protected int $size = 0;

    public function pad(string $value): string
    {
        if ($this->size) {
            $value = str_pad($value, $this->size, $this->padString, $this->position);
        }

        return $value;
    }

    public function trim(string $value): string
    {
        if (! $this->size) {
            return $value;
        }

        if ($this->position === STR_PAD_LEFT) {
            return substr($value, -$this->size);
        }

        return  substr($value, 0, $this->size);
    }

    public function setPadString(?string $padString): self
    {
        $this->padString = $padString ?? self::DEFAULT_PAD_STRING;

        return $this;
    }

    public function setPosition(?int $position): self
    {
        $this->position = $position ?? self::DEFAULT_POSITION;

        return $this;
    }

    public function setSize(int $size = 0): self
    {
        $this->size = $size;

        return $this;
    }
}
