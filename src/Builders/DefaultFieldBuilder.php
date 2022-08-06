<?php

namespace LauanaOh\Iso8583\Builders;

use LauanaOh\Iso8583\Constants\Tag;
use LauanaOh\Iso8583\Contracts\FieldBuilderContract;
use LauanaOh\Iso8583\Contracts\FieldContract;
use LauanaOh\Iso8583\Contracts\LengthContract;
use LauanaOh\Iso8583\Contracts\PaddingContract;
use LauanaOh\Iso8583\Contracts\TagContract;
use LauanaOh\Iso8583\Contracts\TypeContract;
use LauanaOh\Iso8583\Helpers\ContainerHelper;

class DefaultFieldBuilder implements FieldBuilderContract
{
    public function createField(string $field, array $settings): FieldContract
    {
        return $this->buildField(
            $this->getTagPipe($field, $settings),
            $this->getLengthPipe($settings),
            $this->getValuePipe($settings),
            $this->getPadding($settings['padding'])
        );
    }

    protected function buildField(TagContract $key, LengthContract $length, TypeContract $value, PaddingContract $padding): FieldContract
    {
        return ContainerHelper::getNewField()
            ->setComponents(compact('key', 'length', 'value'))
            ->setPadding($padding);
    }

    protected function getTagPipe(string $field, array $settings): TagContract
    {
        return ContainerHelper::getTag(Tag::TYPE_INVISIBLE)->setValue($field);
    }

    protected function getLengthPipe(array $settings): LengthContract
    {
        return ContainerHelper::getLength($settings['type']['length'])
            ->setEncoder(ContainerHelper::getEncoder($settings['encode']['length']))
            ->setSize($settings['length']);
    }

    protected function getValuePipe(array $settings): TypeContract
    {
        return ContainerHelper::getType($settings['type']['value'])
            ->setEncoder(ContainerHelper::getEncoder($settings['encode']['value']));
    }

    protected function getPadding($settings): PaddingContract
    {
        return ContainerHelper::getNewPadding()
            ->setPadString($settings['value'])
            ->setPosition($settings['position'])
            ->setSize($settings['length']);
    }
}
