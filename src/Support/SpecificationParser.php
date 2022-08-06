<?php

namespace LauanaOh\Iso8583\Support;

use LauanaOh\Iso8583\Contracts\SpecificationParserContract;
use LauanaOh\Iso8583\Helpers\ContainerHelper;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SpecificationParser extends OptionsResolver implements SpecificationParserContract
{
    public function __construct()
    {
        $this->defineOverride();
        $this->defineFields();
    }

    public function prepareSettings(array $settings): array
    {
        return $this->resolve($settings);
    }

    protected function defineOverride()
    {
        $this->define('override')->allowedTypes('bool')->default(false);
    }

    protected function defineFields()
    {
        $this->define('fields')
            ->allowedTypes('array')
            ->default(ContainerHelper::getBaseSpecification())
            ->normalize(function (Options $options, $value) {
                if (! $options['override']) {
                    $value = array_replace(ContainerHelper::getBaseSpecification(), $value);
                }

                return $this->normalizeEncode($value);
            });
    }

    protected function normalizeEncode($value): array
    {
        return array_map(function ($data) {
            if (isset($data['encode']) && is_string($data['encode'])) {
                $encodes = explode(',', $data['encode']);
                $data['encode'] = array_map('trim', $encodes);
            }

            if (isset($data['compound'])) {
                $data['compound']['fields'] = $this->normalizeEncode($data['compound']['fields']);
            }

            return $data;
        }, $value);
    }
}
