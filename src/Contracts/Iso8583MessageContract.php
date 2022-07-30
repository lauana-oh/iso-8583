<?php

namespace Lauana\Iso\Contracts;

interface Iso8583MessageContract
{
    public function setSpecification(array $settings): Iso8583MessageContract;

    public function pack(array $fieldsData);

    public function unpack(string $message);
}