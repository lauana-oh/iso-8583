<?php

namespace Lauana\Iso\Entities;

use Lauana\Iso\Exceptions\ByteStreamExhaustException;
use Stringable;

class ByteStream implements Stringable
{
    private string $currentBytes;

    public function __construct(string $bytes = '')
    {
        $this->currentBytes = $bytes;
    }

    public function getAndMoveCursor(int $length): string
    {
        if ($this->currentBytes === '' || strlen($this->currentBytes) < $length) {
            throw new ByteStreamExhaustException(
                'The message stream is exhaust'
            );
        }

        $data = substr($this->currentBytes, 0, $length);
        $this->currentBytes = substr($this->currentBytes, $length);

        return $data;
    }

    public function getNewByteStreamAndMoveCursor(int $length): self
    {
        return new self($this->getAndMoveCursor($length));
    }

    public function concat(string $bytes): self
    {
        $this->currentBytes .= $bytes;

        return $this;
    }

    public function prepend(string $bytes): self
    {
        $this->currentBytes = $bytes.$this->currentBytes;

        return $this;
    }

    public function getCurrentBytes(): string
    {
        return $this->currentBytes;
    }

    public function __toString()
    {
        return $this->getCurrentBytes();
    }
}