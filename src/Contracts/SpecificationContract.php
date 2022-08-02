<?php

namespace LauanaOh\Iso8583\Contracts;

interface SpecificationContract
{
    public function loadSettings(array $settings): self;

    public function getFieldPipe(string $field): PipeContract;
}
