<?php

namespace LauanaOh\Iso8583\Helpers;

use LauanaOh\Iso8583\Constants\Tag;
use LauanaOh\Iso8583\Contracts\BitmapContract;
use LauanaOh\Iso8583\Contracts\CompoundTypeContract;
use LauanaOh\Iso8583\Contracts\FieldBuilderContract;
use LauanaOh\Iso8583\Contracts\EncoderContract;
use LauanaOh\Iso8583\Contracts\FieldContract;
use LauanaOh\Iso8583\Contracts\Iso8583MessageContract;
use LauanaOh\Iso8583\Contracts\LengthContract;
use LauanaOh\Iso8583\Contracts\NormalizerContract;
use LauanaOh\Iso8583\Contracts\PaddingContract;
use LauanaOh\Iso8583\Contracts\SpecificationContract;
use LauanaOh\Iso8583\Contracts\SpecificationParserContract;
use LauanaOh\Iso8583\Contracts\SpecificationResolverContract;
use LauanaOh\Iso8583\Contracts\ValidationContract;
use LauanaOh\Iso8583\Contracts\TagContract;
use LauanaOh\Iso8583\Contracts\TypeContract;
use LauanaOh\Iso8583\Exceptions\ContainerException;

class ContainerHelper
{
    public static function isDefined(string $key): bool
    {
        return iso8583_container()->offsetExists($key);
    }

    public static function get(string $key)
    {
        return iso8583_container($key);
    }

    public static function getIso8583Message(): Iso8583MessageContract
    {
        return iso8583_container(Iso8583MessageContract::class);
    }

    public static function getBaseSpecification(): array
    {
        return iso8583_container('base_specification');
    }

    public static function getDefaultFieldBuilder(): FieldBuilderContract
    {
        return self::getFieldBuilder(Tag::POSITION_NONE);
    }

    public static function getFieldBuilder(string $tagPosition): FieldBuilderContract
    {
        return iso8583_container('builder_'.$tagPosition);
    }

    public static function getBitmap(): BitmapContract
    {
        return iso8583_container(BitmapContract::class);
    }

    public static function getNewField(): FieldContract
    {
        return iso8583_container(FieldContract::class);
    }

    public static function getNewPadding(): PaddingContract
    {
        return iso8583_container(PaddingContract::class);
    }

    public static function loadSpecification(array $settings = []): SpecificationContract
    {
        return iso8583_container(SpecificationContract::class)->loadSettings($settings);
    }

    public static function getSpecificationResolver(): SpecificationResolverContract
    {
        return iso8583_container(SpecificationResolverContract::class);
    }

    public static function getSpecificationParser(): SpecificationParserContract
    {
        return iso8583_container(SpecificationParserContract::class);
    }

    public static function getValidation(string $validation): ValidationContract
    {
        return iso8583_container($validation);
    }

    public static function getNormalizer(string $normalizer): NormalizerContract
    {
        return iso8583_container($normalizer);
    }

    public static function getType(string $type): TypeContract
    {
        return iso8583_container('type_'.$type);
    }

    public static function getCompoundType(string $type): CompoundTypeContract
    {
        return iso8583_container('type_compound_'.$type);
    }

    public static function getLength(string $length): LengthContract
    {
        return iso8583_container('length_'.$length);
    }

    public static function getEncoder(string $encoder): EncoderContract
    {
        return iso8583_container('encoder_'.$encoder);
    }

    public static function getTag(string $tag): TagContract
    {
        return iso8583_container('tag_'.$tag);
    }

    public static function set(string $key, $value)
    {
        unset(iso8583_container()[$key]);

        return iso8583_container()[$key] = $value;
    }

    public static function singleton(string $key, string $implementation)
    {
        unset(iso8583_container()[$key]);
        iso8583_container()[$key] = fn () => new $implementation;

        return iso8583_container($key);
    }

    public static function bind(string $key, string $implementation)
    {
        $container = iso8583_container();

        unset($container[$key]);
        $container[$key] = $container->factory(fn () => new $implementation);

        return iso8583_container($key);
    }

    public static function setType(string $type, string $implementation)
    {
        if (! in_array(TypeContract::class, class_implements($implementation), true)) {
            throw ContainerException::invalidType($type, $implementation);
        }

        return self::bind('type_'.$type, $implementation);
    }

    public static function setEncoder(string $type, string $implementation)
    {
        if (! in_array(EncoderContract::class, class_implements($implementation), true)) {
            throw ContainerException::invalidEncoder($type, $implementation);
        }

        return self::bind('encoder_'.$type, $implementation);
    }

    public static function setLength(string $type, string $implementation)
    {
        if (! in_array(LengthContract::class, class_implements($implementation), true)) {
            throw ContainerException::invalidLength($type, $implementation);
        }

        return self::bind('length_'.strlen($type), $implementation);
    }
}
