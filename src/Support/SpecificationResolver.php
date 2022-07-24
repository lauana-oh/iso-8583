<?php

namespace Lauana\Iso\Support;

use Lauana\Iso\Constants\Encodes;
use Lauana\Iso\Constants\Lengths;
use Lauana\Iso\Constants\Types;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SpecificationResolver extends OptionsResolver
{
    public static function resolveSettings(array $settings)
    {
        $resolver = new self();

        $resolver->defineOverride();
        $resolver->defineFields();

        $settings['fields'] = array_map(function ($data) {
            $encodes = explode(',', $data['encode'] ?? '');
            $data['encode'] = array_map('trim', $encodes);

            return $data;
        }, $settings['fields'] ?? []);

        return $resolver->resolve($settings);
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

                        return in_array($type, Types::SUPPORTED_TYPES, true)
                            && in_array($length, Lengths::SUPPORTED_LENGTHS, true);
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
                            fn ($value) => ! in_array($value, Encodes::SUPPORTED_ENCODES, true)
                        ));
                    })->normalize(function (Options $options, $encodes) {
                        return [
                            'value' => $encodes[1] ?? $encodes[0],
                            'length' => $encodes[0],
                        ];
                    });
            });
    }
}
