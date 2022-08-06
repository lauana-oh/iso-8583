<?php

namespace LauanaOh\Iso8583\Builders;

use LauanaOh\Iso8583\Constants\FieldType;
use LauanaOh\Iso8583\Contracts\TypeContract;
use LauanaOh\Iso8583\Helpers\ContainerHelper;

class FixedCompoundBuilder extends DefaultFieldBuilder
{
    protected function getValuePipe(array $settings): TypeContract
    {
        $tagPosition = $settings['compound']['tag'];

        foreach ($settings['compound']['fields'] as $tag => $tagSettings) {
            $components[$tag] = ContainerHelper::getFieldBuilder($tagPosition)->createField($tag, $tagSettings);
        }

        return ContainerHelper::getCompoundType(FieldType::TYPE_COMPOUND_FIXED)
            ->setComponents($components ?? [])
            ->setEncoder(ContainerHelper::getEncoder($settings['encode']['value']));
    }
}
