<?php

namespace LauanaOh\Iso8583\Support;

use LauanaOh\Iso8583\Contracts\SpecificationResolverContract;
use LauanaOh\Iso8583\Entities\Padding;
use LauanaOh\Iso8583\Helpers\ContainerHelper;
use Symfony\Component\OptionsResolver\Exception\InvalidOptionsException;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SpecificationResolver extends OptionsResolver implements SpecificationResolverContract
{
    public function __construct()
    {
        $this->defineOverride();
        $this->defineFields();
    }

    public function resolveSettings(array $settings): array
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
            ->default(function (OptionsResolver $resolver) {
                $resolver->setPrototype(true);

                $this->defineType($resolver);
                $this->defineLength($resolver);
                $this->defineEncode($resolver);
                $this->definePadding($resolver);
            });
    }

    protected function defineType(OptionsResolver $resolver): void
    {
        $resolver->define('type')
            ->required()
            ->allowedTypes('string')
            ->allowedValues(function ($value) {
                $type = str_replace('.', '', $value, $length);

                return ContainerHelper::isDefined('type_' . $type)
                    && ContainerHelper::isDefined('length_' . $length);
            })->normalize(function (Options $options, $value) {
                $value = str_replace('.', '', $value, $length);

                return compact('value', 'length');
            });
    }

    protected function defineLength(OptionsResolver $resolver): void
    {
        $resolver->define('length')
            ->required()
            ->allowedTypes('int');
    }

    protected function defineEncode(OptionsResolver $resolver): void
    {
        $resolver->define('encode')
            ->required()
            ->allowedTypes('string[]')
            ->allowedValues(function ($encodes) {
                return empty(
                array_filter(
                    $encodes,
                    fn($value) => !ContainerHelper::isDefined('encoder_' . $value)
                )
                );
            })->normalize(function (Options $options, $encodes) {
                return [
                    'value' => $encodes[1] ?? $encodes[0],
                    'length' => $encodes[0],
                ];
            });
    }

    protected function definePadding(OptionsResolver $resolver): void
    {
        $resolver->define('padding')
            ->default(function (OptionsResolver $paddingResolver) {
                $paddingResolver->define('value')
                    ->allowedTypes('string')
                    ->default(Padding::DEFAULT_PAD_STRING);

                $paddingResolver->define('length')
                    ->allowedTypes('int')
                    ->default(0);

                $paddingResolver->define('position')
                    ->allowedValues(function ($value) {
                        if (in_array($value, [STR_PAD_LEFT, STR_PAD_RIGHT], true)) {
                            return true;
                        }

                        throw new InvalidOptionsException(
                            sprintf(
                                'The option "fields[padding][position]" with value "%s" is invalid. Accepted values are: STR_PAD_LEFT (0), STR_PAD_RIGHT (1).',
                                $value
                            )
                        );
                    })
                    ->default(Padding::DEFAULT_POSITION);
            });
    }
}
