<?php

namespace LauanaOh\Iso8583\Contracts;

interface TagContract extends PipeContract
{
    public function setValue(string $value): self;

    public function getValue(): string;
}