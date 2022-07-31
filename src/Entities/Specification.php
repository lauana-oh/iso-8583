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

        return ContainerHelper::getFieldBuilderFactory()
            ->getFieldBuilder($fieldSettings)
            ->createField($field, $fieldSettings);
    }
}
