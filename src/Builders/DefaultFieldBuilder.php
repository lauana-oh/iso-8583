<?php

namespace LauanaOh\Iso8583\Builders;

use LauanaOh\Iso8583\Contracts\FieldBuilderContract;
use LauanaOh\Iso8583\Contracts\FieldContract;
use LauanaOh\Iso8583\Contracts\PipeContract;
use LauanaOh\Iso8583\Helpers\ContainerHelper;

class DefaultFieldBuilder implements FieldBuilderContract
{
    public function createField(string $field, array $settings): FieldContract
    {
        $key = ContainerHelper::getTag('invisible')->setValue($field);

        $length = ContainerHelper::getLength($settings['type']['length'])
            ->setEncoder(ContainerHelper::getEncoder($settings['encode']['length']))
            ->setSize($settings['length']);

        $value = $this->getValuePipe($settings);

        $padding = ContainerHelper::getNewPadding()
            ->setPadString($settings['padding']['value'])
            ->setPosition($settings['padding']['position'])
            ->setSize($settings['padding']['length']);

        return ContainerHelper::getNewField()
            ->setComponents(compact('key', 'length', 'value'))
            ->setPadding($padding);
    }

    protected function getValuePipe(array $settings): PipeContract
    {
        return ContainerHelper::getType($settings['type']['value'])
            ->setEncoder(ContainerHelper::getEncoder($settings['encode']['value']));
    }
}
