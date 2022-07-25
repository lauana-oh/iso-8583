<?php

namespace Lauana\Iso\Contracts;

interface SpecificationResolverContract
{
    public function resolveSettings(array $settings): array;
}