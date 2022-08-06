<?php

/*
|--------------------------------------------------------------------------
| This field contains the services bindings for the iso8583_container
|--------------------------------------------------------------------------
|
| This container following the PSR-11 specification.
*/

use LauanaOh\Iso8583\Builders\TagBeforeBuilder;
use LauanaOh\Iso8583\Builders\DefaultFieldBuilder;
use LauanaOh\Iso8583\Constants\Encode;
use LauanaOh\Iso8583\Constants\Length;
use LauanaOh\Iso8583\Constants\FieldType;
use LauanaOh\Iso8583\Constants\Tag;
use LauanaOh\Iso8583\Contracts\BitmapContract;
use LauanaOh\Iso8583\Contracts\FieldContract;
use LauanaOh\Iso8583\Contracts\Iso8583MessageContract;
use LauanaOh\Iso8583\Contracts\PaddingContract;
use LauanaOh\Iso8583\Contracts\SpecificationContract;
use LauanaOh\Iso8583\Contracts\SpecificationParserContract;
use LauanaOh\Iso8583\Contracts\SpecificationResolverContract;
use LauanaOh\Iso8583\Encoders\ASCII;
use LauanaOh\Iso8583\Encoders\BCD;
use LauanaOh\Iso8583\Entities\Bitmap;
use LauanaOh\Iso8583\Entities\Field;
use LauanaOh\Iso8583\Entities\Padding;
use LauanaOh\Iso8583\Entities\Specification;
use LauanaOh\Iso8583\Iso8583Message;
use LauanaOh\Iso8583\Lengths\Fixed;
use LauanaOh\Iso8583\Lengths\LLLVAR;
use LauanaOh\Iso8583\Lengths\LLVAR;
use LauanaOh\Iso8583\Normalizers\EncodeNormalizer;
use LauanaOh\Iso8583\Normalizers\TypeNormalizer;
use LauanaOh\Iso8583\Support\SpecificationParser;
use LauanaOh\Iso8583\Support\SpecificationResolver;
use LauanaOh\Iso8583\Tags\Invisible;
use LauanaOh\Iso8583\Tags\Visible;
use LauanaOh\Iso8583\Types\Alpha;
use LauanaOh\Iso8583\Types\AlphaNumeric;
use LauanaOh\Iso8583\Types\AlphaNumericSpecialCharacter;
use LauanaOh\Iso8583\Types\AlphaSpecialCharacter;
use LauanaOh\Iso8583\Types\Binary;
use LauanaOh\Iso8583\Types\FixedCompound;
use LauanaOh\Iso8583\Types\Numeric;
use LauanaOh\Iso8583\Types\NumericSpecialCharacter;
use LauanaOh\Iso8583\Types\SpecialCharacter;
use LauanaOh\Iso8583\Validations\BuilderValidation;
use LauanaOh\Iso8583\Validations\PaddingPositionValidation;
use LauanaOh\Iso8583\Validations\EncodeValidation;
use LauanaOh\Iso8583\Validations\TypeValidation;

/*
|--------------------------------------------------------------------------
| Parameters bindings.
|--------------------------------------------------------------------------
|
| This section set the bindings of parameters to the
| package.
*/

$container[BitmapContract::class] = fn () => new Bitmap();
$container[Iso8583MessageContract::class] = $container->factory(fn () => new Iso8583Message());
$container[FieldContract::class] = $container->factory(fn () => new Field());
$container[PaddingContract::class] = $container->factory(fn () => new Padding());

/*
|--------------------------------------------------------------------------
| Field builders bindings.
|--------------------------------------------------------------------------
|
| This section set the bindings of field builders support natively to the
| package.
*/

$container['builder_'.Tag::POSITION_NONE] = fn () => new DefaultFieldBuilder();
$container['builder_'.Tag::POSITION_BEFORE] = fn () => new TagBeforeBuilder();

/*
|--------------------------------------------------------------------------
| Specification bindings.
|--------------------------------------------------------------------------
|
| This section set the bindings of specification to the
| package.
*/

$container['base_specification'] = fn () => require 'base_specification.php';
$container[SpecificationContract::class] = fn () => new Specification();
$container[SpecificationResolverContract::class] = fn () => new SpecificationResolver();
$container[SpecificationParserContract::class] = fn () => new SpecificationParser();

$container[TypeValidation::class] = fn () => new TypeValidation();
$container[EncodeValidation::class] = fn () => new EncodeValidation();
$container[PaddingPositionValidation::class] = fn () => new PaddingPositionValidation();
$container[BuilderValidation::class] = fn () => new BuilderValidation();

$container[TypeNormalizer::class] = fn () => new TypeNormalizer();
$container[EncodeNormalizer::class] = fn () => new EncodeNormalizer();

/*
|--------------------------------------------------------------------------
| Encoders bindings.
|--------------------------------------------------------------------------
|
| This section set the bindings of encoder types support natively to the
| package.
*/

$container['encoder_'.Encode::TYPE_BCD] = fn () => new BCD();
$container['encoder_'.Encode::TYPE_ASCII] = fn () => new ASCII();

/*
|--------------------------------------------------------------------------
| Data type bindings.
|--------------------------------------------------------------------------
|
| This section set the bindings of data types support natively to the
| package.
*/

$container['type_'.FieldType::TYPE_ALPHA] = $container->factory(fn () => new Alpha());
$container['type_'.FieldType::TYPE_ALPHANUMERIC] = $container->factory(fn () => new AlphaNumeric());
$container['type_'.FieldType::TYPE_ALPHANUMERIC_SPECIAL_CHAR] = $container->factory(fn () => new AlphaNumericSpecialCharacter());
$container['type_'.FieldType::TYPE_ALPHA_SPECIAL_CHAR] = $container->factory(fn () => new AlphaSpecialCharacter());
$container['type_'.FieldType::TYPE_BINARY] = $container->factory(fn () => new Binary());
$container['type_'.FieldType::TYPE_NUMERIC] = $container->factory(fn () => new Numeric());
$container['type_'.FieldType::TYPE_NUMERIC_SPECIAL_CHAR] = $container->factory(fn () => new NumericSpecialCharacter());
$container['type_'.FieldType::TYPE_SPECIAL_CHAR] = $container->factory(fn () => new SpecialCharacter());

$container['type_compound_'.FieldType::TYPE_COMPOUND_FIXED] = $container->factory(fn () => new FixedCompound());

/*
|--------------------------------------------------------------------------
| Length type bindings.
|--------------------------------------------------------------------------
|
| This section set the bindings of length types support natively to the
| package.
*/

$container['length_'.strlen(Length::TYPE_FIXED)] = $container->factory(fn () => new Fixed());
$container['length_'.strlen(Length::TYPE_LLVAR)] = $container->factory(fn () => new LLVAR());
$container['length_'.strlen(Length::TYPE_LLLVAR)] = $container->factory(fn () => new LLLVAR());

/*
|--------------------------------------------------------------------------
| Tag type bindings.
|--------------------------------------------------------------------------
|
| This section set the bindings of tag types support natively to the
| package.
*/

$container['tag_'.Tag::TYPE_INVISIBLE] = $container->factory(fn () => new Invisible());
$container['tag_'.Tag::TYPE_VISIBLE] = $container->factory(fn () => new Visible());
