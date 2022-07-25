<?php

namespace Lauana\Iso\Entities;

class Padding
{
    protected bool $isActive = false;
    protected string $padString = '0';
    protected int $type = STR_PAD_LEFT;

    public function pad(string $value, int $size): string
    {
        if ($this->isActive) {
            $value = str_pad($value, $size, $this->padString, $this->type);
        }

        return $value;
    }

    public function unpad(string $value): string
    {
        if (!$this->isActive) {
            return $value;
        }

        if ($this->type === STR_PAD_LEFT) {
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

    public function setType(int $type): self
    {
        $this->type = $type;
        return $this;
    }
}