<?php

namespace LauanaOh\Iso8583\Contracts;

interface FieldBuilderContract
{
    public function createField(string $field, array $settings): FieldContract;
}
