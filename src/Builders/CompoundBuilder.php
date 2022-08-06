<?php

namespace LauanaOh\Iso8583\Builders;

use LauanaOh\Iso8583\Constants\FieldType;
use LauanaOh\Iso8583\Contracts\PipeContract;
use LauanaOh\Iso8583\Helpers\ContainerHelper;

class CompoundBuilder extends DefaultFieldBuilder
{
    protected function getValuePipe(array $settings): PipeContract
    {
        foreach ($settings['compound']['fields'] as $tag => $tagSettings) {
            $components[$tag] = ContainerHelper::getDefaultFieldBuilder()->createField($tag, $tagSettings);
        }

        return ContainerHelper::getCompoundType($this->getCompoundType($settings))
            ->setComponents($components ?? [])
            ->setEncoder(ContainerHelper::getEncoder($settings['encode']['value']));
    }

    protected function getCompoundType($settings): string
    {

        return FieldType::TYPE_COMPOUND_FIXED;
    }
}
