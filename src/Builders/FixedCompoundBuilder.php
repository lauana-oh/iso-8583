<?php

namespace LauanaOh\Iso8583\Builders;

use LauanaOh\Iso8583\Constants\Types;
use LauanaOh\Iso8583\Contracts\PipeContract;
use LauanaOh\Iso8583\Helpers\ContainerHelper;

class FixedCompoundBuilder extends DefaultFieldBuilder
{
    protected function getValuePipe(array $settings): PipeContract
    {
        foreach ($settings['compound']['fields'] as $tag => $tagSettings) {
            $components[$tag] = ContainerHelper::getDefaultFieldBuilder()->createField($tag, $tagSettings);
        }

        return ContainerHelper::getCompoundType(Types::TYPE_COMPOUND_FIXED)
            ->setComponents($components ?? [])
            ->setEncoder(ContainerHelper::getEncoder($settings['encode']['value']));
    }
}
