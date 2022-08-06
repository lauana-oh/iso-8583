<?php

namespace LauanaOh\Iso8583\Contracts;

interface SpecificationParserContract
{
    public function prepareSettings(array $settings): array;
}
