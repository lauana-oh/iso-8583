<?php

namespace Lauana\Iso\Entities;

use Lauana\Iso\Contracts\PipeContract;
use Lauana\Iso\Helpers\ContainerHelper;

class Specification
{
    private array $settings;

    public function __construct(array $settings)
    {
        if ($settings['override'] ?? true) {
            $settings['fields'] = array_replace(iso8583_container('base_specification'), $settings['fields'] ?? []);
        }

        $settings['fields'] = array_map(function ($data) {
            if (isset($data['encode']) && is_string($data['encode'])) {
                $encodes = explode(',', $data['encode']);
                $data['encode'] = array_map('trim', $encodes);
            }

            return $data;
        }, $settings['fields'] ?? []);

        $this->settings = ContainerHelper::getSpecificationResolver()->resolveSettings($settings);
    }

    public function getFieldPipe(string $field): PipeContract
    {
        if ($field === 'bitmap') {
            return new Bitmap();
        }

        if (!isset($this->settings['fields'][$field])) {
            throw new \Exception();
        }

        $fieldSettings = $this->settings['fields'][$field];

        $key = ContainerHelper::getTag('invisible')->setValue($field);

        $length = ContainerHelper::getLength($fieldSettings['type']['length'])
            ->setEncoder(ContainerHelper::getEncoder($fieldSettings['encode']['length']))
            ->setSize($fieldSettings['length']);

        $value = ContainerHelper::getType($fieldSettings['type']['value'])
            ->setEncoder(ContainerHelper::getEncoder($fieldSettings['encode']['value']));

        return ContainerHelper::getNewField()->setComponents(compact('key', 'length', 'value'));
    }
}