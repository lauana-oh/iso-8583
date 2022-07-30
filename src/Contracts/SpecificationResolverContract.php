<?php

namespace LauanaOh\Iso8583\Contracts;

interface SpecificationResolverContract
{
    public function resolveSettings(array $settings): array;
}
