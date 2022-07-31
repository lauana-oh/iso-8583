<?php

namespace LauanaOh\Iso8583\Support;

use LauanaOh\Iso8583\Contract\SpecificationNormalizerContract;
use LauanaOh\Iso8583\Helpers\ContainerHelper;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SpecificationNormalizer extends OptionsResolver implements SpecificationNormalizerContract
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

                return array_map(function ($data) {
                    if (isset($data['encode']) && is_string($data['encode'])) {
                        $encodes = explode(',', $data['encode']);
                        $data['encode'] = array_map('trim', $encodes);
                    }

                    return $data;
                }, $value);
            });
    }
}
