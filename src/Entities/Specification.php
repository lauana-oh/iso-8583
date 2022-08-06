<?php

namespace LauanaOh\Iso8583\Entities;

use LauanaOh\Iso8583\Contracts\FieldBuilderContract;
use LauanaOh\Iso8583\Contracts\PipeContract;
use LauanaOh\Iso8583\Contracts\SpecificationContract;
use LauanaOh\Iso8583\Exceptions\InvalidFieldException;
use LauanaOh\Iso8583\Helpers\ContainerHelper;

class Specification implements SpecificationContract
{
    private array $settings;

    public function loadSettings(array $settings): self
    {
        $this->settings = ContainerHelper::getSpecificationResolver()->resolveSettings(
            ContainerHelper::getSpecificationParser()->prepareSettings($settings)
        );

        return $this;
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

        return $this->getFieldBuilder($fieldSettings)->createField($field, $fieldSettings);
    }

    public function toArray(): array
    {
        return $this->settings;
    }

    protected function getFieldBuilder(array $settings): FieldBuilderContract
    {
        return empty($settings['compound']['fields'])
            ? ContainerHelper::getDefaultFieldBuilder()
            : $settings['compound']['builder'];
    }
}
