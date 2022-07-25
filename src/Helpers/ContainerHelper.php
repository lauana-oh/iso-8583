<?php

namespace Lauana\Iso\Helpers;

use Lauana\Iso\Contracts\EncoderContract;
use Lauana\Iso\Contracts\SpecificationResolverContract;
use Lauana\Iso\Entities\Field;
use Lauana\Iso\Iso8583Message;
use Lauana\Iso\Lengths\BaseLength;
use Lauana\Iso\Tags\BaseTag;
use Lauana\Iso\Types\BaseType;

class ContainerHelper
{
    public static function isDefined(string $key): bool
    {
        return iso8583_container()->offsetExists($key);
    }

    public static function getIso8583Message(): Iso8583Message
    {
        return iso8583_container(Iso8583Message::class);
    }

    public static function getNewField(): Field
    {
        return iso8583_container(Field::class);
    }

    public static function getSpecificationResolver(): SpecificationResolverContract
    {
        return iso8583_container('specificationResolver');
    }

    public static function getType(string $type): BaseType
    {
        return iso8583_container('type_'. $type);
    }

    public static function getLength(string $length): BaseLength
    {
        return iso8583_container('length_'. $length);
    }

    public static function getEncoder(string $encoder): EncoderContract
    {
        return iso8583_container('encoder_'. $encoder);
    }

    public static function getTag(string $tag): BaseTag
    {
        return iso8583_container('tag_'. $tag);
    }
}