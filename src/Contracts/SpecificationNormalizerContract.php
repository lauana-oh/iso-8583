<?php

namespace LauanaOh\Iso8583\Contracts;

interface SpecificationNormalizerContract
{
    public function prepareSettings(array $settings): array;
}
