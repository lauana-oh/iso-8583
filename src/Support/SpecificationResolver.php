<?php

namespace LauanaOh\Iso8583\Support;

use LauanaOh\Iso8583\Contracts\SpecificationResolverContract;
use LauanaOh\Iso8583\Helpers\ContainerHelper;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SpecificationResolver extends OptionsResolver implements SpecificationResolverContract
{
    public function resolveSettings(array $settings): array
    {
        $this->defineOverride();
        $this->defineFields();

        return $this->resolve($settings);
    }

    protected function defineOverride()
    {
        $this->define('override')->allowedTypes('bool')->default(false);
    }

    protected function defineFields()
    {
        $this->define('fields')
            ->default(function (OptionsResolver $resolver) {
                $resolver->setPrototype(true);

                $resolver->define('type')
                    ->required()
                    ->allowedTypes('string')
                    ->allowedValues(function ($value) {
                        $type = str_replace('.', '', $value, $length);

                        return ContainerHelper::isDefined('type_'.$type)
                            && ContainerHelper::isDefined('length_'.$length);
                    })->normalize(function (Options $options, $value) {
                        $value = str_replace('.', '', $value, $length);

                        return compact('value', 'length');
                    });

                $resolver->define('length')
                    ->required()
                    ->allowedTypes('int');

                $resolver->define('encode')
                    ->required()
                    ->allowedTypes('string[]')
                    ->allowedValues(function ($encodes) {
                        return empty(array_filter(
                            $encodes,
                            fn ($value) => ! ContainerHelper::isDefined('encoder_'.$value)
                        ));
                    })->normalize(function (Options $options, $encodes) {
                        return [
                            'value' => $encodes[1] ?? $encodes[0],
                            'length' => $encodes[0],
                        ];
                    });

                $resolver->define('padding')
                    ->default(function (OptionsResolver $paddingResolver) {
                        $paddingResolver->define('value')->allowedTypes('string');
                        $paddingResolver->define('length')->allowedTypes('int');
                        $paddingResolver->define('position')->allowedValues(STR_PAD_LEFT, STR_PAD_RIGHT);
                    });
            });
    }
}
