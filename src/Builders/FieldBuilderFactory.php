<?php

namespace LauanaOh\Iso8583\Builders;

use LauanaOh\Iso8583\Contracts\FieldBuilderFactoryContract;
use LauanaOh\Iso8583\Contracts\FieldBuilderContract;

class FieldBuilderFactory implements FieldBuilderFactoryContract
{
    public function getFieldBuilder(array $settings): FieldBuilderContract
    {
        return new SimpleFieldBuilder();
    }
}