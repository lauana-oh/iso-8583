<?php

namespace Lauana\Iso\Entities;

class DataHolder
{
    protected array $data = [];

    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    public function setField(string $key, $data)
    {
        $this->data[$key] = $data;
    }

    public function getField(string $key)
    {
        return $this->data[$key] ?? null;
    }

    public function unsetField(string $key)
    {
        unset($this->data[$key]);

        return $this;
    }

    public function toArray(): array
    {
        return array_map(function ($value) {
            return $value instanceof self ? $value->toArray() : $value;
        }, $this->data);
    }
}
