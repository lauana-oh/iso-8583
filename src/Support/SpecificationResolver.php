<?php

namespace LauanaOh\Iso8583\Support;

use LauanaOh\Iso8583\Contracts\SpecificationResolverContract;
use LauanaOh\Iso8583\Entities\Padding;
use LauanaOh\Iso8583\Helpers\ContainerHelper;
use LauanaOh\Iso8583\Normalizers\EncodeNormalizer;
use LauanaOh\Iso8583\Normalizers\TypeNormalizer;
use LauanaOh\Iso8583\Validations\PaddingPositionValidation;
use LauanaOh\Iso8583\Validations\BuilderValidation;
use LauanaOh\Iso8583\Validations\EncodeValidation;
use LauanaOh\Iso8583\Validations\TypeValidation;
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
                $this->defineCompound($resolver);
            });
    }

    protected function defineType(OptionsResolver $resolver): void
    {
        $resolver->define('type')
            ->required()
            ->allowedTypes('string')
            ->allowedValues(ContainerHelper::getValidation(TypeValidation::class)->createCallable())
            ->normalize(ContainerHelper::getNormalizer(TypeNormalizer::class)->createCallable());
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
            ->allowedValues(ContainerHelper::getValidation(EncodeValidation::class)->createCallable())
            ->normalize(ContainerHelper::getNormalizer(EncodeNormalizer::class)->createCallable());
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
                    ->allowedValues(
                        ContainerHelper::getValidation(PaddingPositionValidation::class)->createCallable()
                    )->default(Padding::DEFAULT_POSITION);
            });
    }

    protected function defineCompound(OptionsResolver $resolver)
    {
        $resolver->define('compound')->default(function (OptionsResolver $compoundResolver) {
            $compoundResolver->define('builder')
                ->allowedValues(ContainerHelper::getValidation(BuilderValidation::class)->createCallable())
                ->normalize(fn (Options $options, $value) => is_string($value) ? new $value() : $value);

            $compoundResolver->define('fields')->default(function (OptionsResolver $fieldsResolver) {
                $fieldsResolver->setPrototype(true);

                $this->defineType($fieldsResolver);
                $this->defineEncode($fieldsResolver);
                $this->defineLength($fieldsResolver);
                $this->definePadding($fieldsResolver);
            });
        });
    }
}
