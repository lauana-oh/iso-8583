<?php

namespace LauanaOh\Iso8583\Helpers;

use LauanaOh\Iso8583\Contract\SpecificationNormalizerContract;
use LauanaOh\Iso8583\Contracts\BitmapContract;
use LauanaOh\Iso8583\Contracts\EncoderContract;
use LauanaOh\Iso8583\Contracts\FieldContract;
use LauanaOh\Iso8583\Contracts\Iso8583MessageContract;
use LauanaOh\Iso8583\Contracts\PaddingContract;
use LauanaOh\Iso8583\Contracts\SpecificationResolverContract;
use LauanaOh\Iso8583\Lengths\BaseLength;
use LauanaOh\Iso8583\Tags\BaseTag;
use LauanaOh\Iso8583\Types\BaseType;

class ContainerHelper
{
    public static function isDefined(string $key): bool
    {
        return iso8583_container()->offsetExists($key);
    }

    public static function getIso8583Message(): Iso8583MessageContract
    {
        return iso8583_container(Iso8583MessageContract::class);
    }

    public static function getBaseSpecification(): array
    {
        return iso8583_container('base_specification');
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

    public static function getSpecificationResolver(): SpecificationResolverContract
    {
        return iso8583_container(SpecificationResolverContract::class);
    }

    public static function getSpecificationNormalizer(): SpecificationNormalizerContract
    {
        return iso8583_container(SpecificationNormalizerContract::class);
    }

    public static function getType(string $type): BaseType
    {
        return iso8583_container('type_'.$type);
    }

    public static function getLength(string $length): BaseLength
    {
        return iso8583_container('length_'.$length);
    }

    public static function getEncoder(string $encoder): EncoderContract
    {
        return iso8583_container('encoder_'.$encoder);
    }

    public static function getTag(string $tag): BaseTag
    {
        return iso8583_container('tag_'.$tag);
    }
}
