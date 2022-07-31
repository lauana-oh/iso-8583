<?php

namespace LauanaOh\Iso8583\Contracts;

interface FieldBuilderFactoryContract
{
    public function getFieldBuilder(array $settings): FieldBuilderContract;
}