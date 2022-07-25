<?php

/*
|--------------------------------------------------------------------------
| This field contains the services bindings for the iso8583_container
|--------------------------------------------------------------------------
|
| This container following the PSR-11 specification.
*/

use Lauana\Iso\Constants\Encodes;
use Lauana\Iso\Constants\Lengths;
use Lauana\Iso\Constants\Types;
use Lauana\Iso\Encoders\ASCII;
use Lauana\Iso\Encoders\BCD;
use Lauana\Iso\Entities\Field;
use Lauana\Iso\Iso8583Message;
use Lauana\Iso\Lengths\Fixed;
use Lauana\Iso\Lengths\Lllvar;
use Lauana\Iso\Lengths\Llvar;
use Lauana\Iso\Support\SpecificationResolver;
use Lauana\Iso\Tags\Invisible;
use Lauana\Iso\Types\Alpha;
use Lauana\Iso\Types\AlphaNumeric;
use Lauana\Iso\Types\AlphaNumericSpecialCharacter;
use Lauana\Iso\Types\Binary;
use Lauana\Iso\Types\Numeric;
use Lauana\Iso\Types\NumericSpecialCharacter;
use Lauana\Iso\Types\SpecialCharacter;


/*
|--------------------------------------------------------------------------
| Parameters bindings.
|--------------------------------------------------------------------------
|
| This section set the bindings of parameters to the
| package.
*/

$container['base_specification'] = fn () => require 'base_specification.php';
$container[Iso8583Message::class] = $container->factory(fn () => new Iso8583Message());
$container['specificationResolver'] = $container->factory(fn() => new SpecificationResolver());
$container[Field::class] = $container->factory(fn () => new Field());

/*
|--------------------------------------------------------------------------
| Encoders bindings.
|--------------------------------------------------------------------------
|
| This section set the bindings of encoder types support natively to the
| package.
*/

$container['encoder_' . Encodes::TYPE_BCD] = fn() => new BCD();
$container['encoder_' . Encodes::TYPE_ASCII] = fn() => new ASCII();

/*
|--------------------------------------------------------------------------
| Data type bindings.
|--------------------------------------------------------------------------
|
| This section set the bindings of data types support natively to the
| package.
*/

$container['type_' . Types::TYPE_ALPHA] = $container->factory(fn () => new Alpha());
$container['type_' . Types::TYPE_ALPHANUMERIC] = $container->factory(fn () => new AlphaNumeric());
$container['type_' . Types::TYPE_ALPHANUMERIC_SPECIAL_CHAR] = $container->factory(fn () => new AlphaNumericSpecialCharacter());
$container['type_' . Types::TYPE_BINARY] = $container->factory(fn () => new Binary());
$container['type_' . Types::TYPE_NUMERIC] = $container->factory(fn () => new Numeric());
$container['type_' . Types::TYPE_NUMERIC_SPECIAL_CHAR] = $container->factory(fn () => new NumericSpecialCharacter());
$container['type_' . Types::TYPE_SPECIAL_CHAR] = $container->factory(fn () => new SpecialCharacter());

/*
|--------------------------------------------------------------------------
| Length type bindings.
|--------------------------------------------------------------------------
|
| This section set the bindings of length types support natively to the
| package.
*/

$container['length_'. strlen(Lengths::TYPE_FIXED)] = $container->factory(fn () => new Fixed());
$container['length_'. strlen(Lengths::TYPE_LLVAR)] = $container->factory(fn () => new Llvar());
$container['length_'. strlen(Lengths::TYPE_LLLVAR)] = $container->factory(fn () => new Lllvar());

/*
|--------------------------------------------------------------------------
| Tag type bindings.
|--------------------------------------------------------------------------
|
| This section set the bindings of tag types support natively to the
| package.
*/

$container['tag_invisible'] = $container->factory(fn () => new Invisible());