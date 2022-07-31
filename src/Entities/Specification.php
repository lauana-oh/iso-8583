<?php

namespace LauanaOh\Iso8583\Entities;

use LauanaOh\Iso8583\Contracts\PipeContract;
use LauanaOh\Iso8583\Exceptions\InvalidFieldException;
use LauanaOh\Iso8583\Helpers\ContainerHelper;

class Specification
{
    private array $settings;

    public function __construct(array $settings)
    {
        $this->settings = ContainerHelper::getSpecificationResolver()->resolveSettings(
            ContainerHelper::getSpecificationNormalizer()->prepareSettings($settings)
        );
    }

    public function getFieldPipe(string $field): PipeContract
    {
        if ($field === 'bitmap') {
            return ContainerHelper::getBitmap();
        }

        if (! isset($this->settings['fields'][$field])) {
            throw InvalidFieldException::undefinedField($field);
        }

        $fieldSettings = $this->settings['fields'][$field];

        $key = ContainerHelper::getTag('invisible')->setValue($field);

        $length = ContainerHelper::getLength($fieldSettings['type']['length'])
            ->setEncoder(ContainerHelper::getEncoder($fieldSettings['encode']['length']))
            ->setSize($fieldSettings['length']);

        $value = ContainerHelper::getType($fieldSettings['type']['value'])
            ->setEncoder(ContainerHelper::getEncoder($fieldSettings['encode']['value']));

        $padding = ContainerHelper::getNewPadding()
            ->setPadString($fieldSettings['padding']['value'])
            ->setPosition($fieldSettings['padding']['position'])
            ->setSize($fieldSettings['padding']['length']);

        return ContainerHelper::getNewField()
            ->setComponents(compact('key', 'length', 'value'))
            ->setPadding($padding);
    }
}
