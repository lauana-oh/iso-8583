<?php

namespace LauanaOh\Iso8583\Contracts;

interface Iso8583MessageContract
{
    public function setSpecification(array $settings): self;

    public function pack(array $fieldsData);

    public function unpack(string $message);
}
