<?php

/*
|--------------------------------------------------------------------------
| This field contains the services bindings for the iso8583_container
|--------------------------------------------------------------------------
|
| This container following the PSR-11 specification.
*/

use LauanaOh\Iso8583\Constants\Encodes;
use LauanaOh\Iso8583\Constants\Lengths;
use LauanaOh\Iso8583\Constants\Types;
use LauanaOh\Iso8583\Contracts\BitmapContract;
use LauanaOh\Iso8583\Contracts\FieldContract;
use LauanaOh\Iso8583\Contracts\Iso8583MessageContract;
use LauanaOh\Iso8583\Contracts\PaddingContract;
use LauanaOh\Iso8583\Contracts\SpecificationResolverContract;
use LauanaOh\Iso8583\Encoders\ASCII;
use LauanaOh\Iso8583\Encoders\BCD;
use LauanaOh\Iso8583\Entities\Bitmap;
use LauanaOh\Iso8583\Entities\Field;
use LauanaOh\Iso8583\Entities\Padding;
use LauanaOh\Iso8583\Iso8583Message;
use LauanaOh\Iso8583\Lengths\Fixed;
use LauanaOh\Iso8583\Lengths\Lllvar;
use LauanaOh\Iso8583\Lengths\Llvar;
use LauanaOh\Iso8583\Support\SpecificationResolver;
use LauanaOh\Iso8583\Tags\Invisible;
use LauanaOh\Iso8583\Types\Alpha;
use LauanaOh\Iso8583\Types\AlphaNumeric;
use LauanaOh\Iso8583\Types\AlphaNumericSpecialCharacter;
use LauanaOh\Iso8583\Types\Binary;
use LauanaOh\Iso8583\Types\Numeric;
use LauanaOh\Iso8583\Types\NumericSpecialCharacter;
use LauanaOh\Iso8583\Types\SpecialCharacter;

/*
|--------------------------------------------------------------------------
| Parameters bindings.
|--------------------------------------------------------------------------
|
| This section set the bindings of parameters to the
| package.
*/

$container['base_specification'] = fn () => require 'base_specification.php';
$container[Iso8583MessageContract::class] = $container->factory(fn () => new Iso8583Message());
$container[SpecificationResolverContract::class] = $container->factory(fn () => new SpecificationResolver());
$container[BitmapContract::class] = fn () => new Bitmap();
$container[FieldContract::class] = $container->factory(fn () => new Field());
$container[PaddingContract::class] = $container->factory(fn () => new Padding());

/*
|--------------------------------------------------------------------------
| Encoders bindings.
|--------------------------------------------------------------------------
|
| This section set the bindings of encoder types support natively to the
| package.
*/

$container['encoder_'.Encodes::TYPE_BCD] = fn () => new BCD();
$container['encoder_'.Encodes::TYPE_ASCII] = fn () => new ASCII();

/*
|--------------------------------------------------------------------------
| Data type bindings.
|--------------------------------------------------------------------------
|
| This section set the bindings of data types support natively to the
| package.
*/

$container['type_'.Types::TYPE_ALPHA] = $container->factory(fn () => new Alpha());
$container['type_'.Types::TYPE_ALPHANUMERIC] = $container->factory(fn () => new AlphaNumeric());
$container['type_'.Types::TYPE_ALPHANUMERIC_SPECIAL_CHAR] = $container->factory(fn () => new AlphaNumericSpecialCharacter());
$container['type_'.Types::TYPE_BINARY] = $container->factory(fn () => new Binary());
$container['type_'.Types::TYPE_NUMERIC] = $container->factory(fn () => new Numeric());
$container['type_'.Types::TYPE_NUMERIC_SPECIAL_CHAR] = $container->factory(fn () => new NumericSpecialCharacter());
$container['type_'.Types::TYPE_SPECIAL_CHAR] = $container->factory(fn () => new SpecialCharacter());

/*
|--------------------------------------------------------------------------
| Length type bindings.
|--------------------------------------------------------------------------
|
| This section set the bindings of length types support natively to the
| package.
*/

$container['length_'.strlen(Lengths::TYPE_FIXED)] = $container->factory(fn () => new Fixed());
$container['length_'.strlen(Lengths::TYPE_LLVAR)] = $container->factory(fn () => new Llvar());
$container['length_'.strlen(Lengths::TYPE_LLLVAR)] = $container->factory(fn () => new Lllvar());

/*
|--------------------------------------------------------------------------
| Tag type bindings.
|--------------------------------------------------------------------------
|
| This section set the bindings of tag types support natively to the
| package.
*/

$container['tag_invisible'] = $container->factory(fn () => new Invisible());
