<?php

namespace LauanaOh\Iso8583\Contract;

interface SpecificationNormalizerContract
{
    public function prepareSettings(array $settings): array;
}
