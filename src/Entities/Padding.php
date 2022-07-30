<?php

namespace Lauana\Iso\Entities;

class Padding
{
    public const DEFAULT_PAD_STRING = '0';
    public const DEFAULT_TYPE = STR_PAD_LEFT;

    protected bool $isActive = false;
    protected string $padString = self::DEFAULT_PAD_STRING;
    protected int $position = self::DEFAULT_TYPE;
    protected int $size = 0;

    public function pad(string $value, int $size): string
    {
        if ($this->isActive) {
            $value = str_pad($value, $size, $this->padString, $this->position);
        }

        if ($this->size) {
            $value = str_pad($value, $this->size, $this->padString, $this->position);
        }

        return $value;
    }

    public function unpad(string $value): string
    {
        if (!$this->isActive) {
            return $value;
        }

        if ($this->position === STR_PAD_LEFT) {
            return substr($value, 1);
        }

        return  substr($value, 0, -1);
    }

    public function isActive(): bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;
        return $this;
    }

    public function setPadString(string $padString): self
    {
        $this->padString = $padString;
        return $this;
    }

    public function setPosition(int $position): self
    {
        $this->position = $position;
        return $this;
    }

    public function setSize(int $size): self
    {
        $this->size = $size;
        return $this;
    }
}