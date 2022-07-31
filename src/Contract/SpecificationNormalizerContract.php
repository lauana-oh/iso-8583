<?php

namespace LauanaOh\Iso8583\Contract;

interface SpecificationNormalizerContract
{
    public function normalizeSettings(array $settings): array;
}
