<?php

namespace Tests\Unit\Helpers;

use LauanaOh\Iso8583\Builders\DefaultFieldBuilder;
use LauanaOh\Iso8583\Contracts\BitmapContract;
use LauanaOh\Iso8583\Contracts\Iso8583MessageContract;
use LauanaOh\Iso8583\Encoders\ASCII;
use LauanaOh\Iso8583\Entities\Field;
use LauanaOh\Iso8583\Entities\Padding;
use LauanaOh\Iso8583\Exceptions\ContainerException;
use LauanaOh\Iso8583\Helpers\ContainerHelper;
use LauanaOh\Iso8583\Iso8583Message;
use LauanaOh\Iso8583\Lengths\LLVAR;
use LauanaOh\Iso8583\Support\SpecificationNormalizer;
use LauanaOh\Iso8583\Support\SpecificationResolver;
use LauanaOh\Iso8583\Types\Numeric;
use PHPUnit\Framework\TestCase;
use Tests\Concerns\HasContainerDataProvider;

class ContainerHelperTest extends TestCase
{
    use HasContainerDataProvider;

    public function testItCanVerifyIfKeyIsDefined()
    {
        self::assertTrue(ContainerHelper::isDefined(Iso8583MessageContract::class));
        self::assertFalse(ContainerHelper::isDefined('blabla'));
    }

    public function testItCanGetAKey()
    {
        self::assertInstanceOf(Iso8583Message::class, ContainerHelper::get(Iso8583MessageContract::class));
    }

    public function testItCanGetIso8583Message()
    {
        self::assertInstanceOf(Iso8583Message::class, ContainerHelper::getIso8583Message());
    }

    public function testItCanGetBaseSpecification()
    {
        $specification = require __DIR__.'/../../../config/base_specification.php';
        self::assertEquals($specification, ContainerHelper::getBaseSpecification());
    }

    public function testItCanGetDefaultFieldBuilder()
    {
        self::assertInstanceOf(DefaultFieldBuilder::class, ContainerHelper::getDefaultFieldBuilder());
    }

    public function testItCanGetBitmap()
    {
        self::assertInstanceOf(BitmapContract::class, ContainerHelper::getBitmap());
    }

    public function testItCanGetNewField()
    {
        self::assertInstanceOf(Field::class, ContainerHelper::getNewField());
    }

    public function testItCanGetNewPadding()
    {
        self::assertInstanceOf(Padding::class, ContainerHelper::getNewPadding());
    }

    public function testItCanGetSpecificationResolver()
    {
        self::assertInstanceOf(SpecificationResolver::class, ContainerHelper::getSpecificationResolver());
    }

    public function testItCanGetSpecificationNormalizer()
    {
        self::assertInstanceOf(SpecificationNormalizer::class, ContainerHelper::getSpecificationNormalizer());
    }

    /**
     * @dataProvider dataTypes
     */
    public function testItCanGetType(string $type, string $class)
    {
        self::assertInstanceOf($class, ContainerHelper::getType($type));
    }

    /**
     * @dataProvider lengths
     */
    public function testItCanGetLength(string $type, string $class)
    {
        self::assertInstanceOf($class, ContainerHelper::getLength(strlen($type)));
    }

    /**
     * @dataProvider encoders
     */
    public function testItCanGetEncoder(string $type, string $class)
    {
        self::assertInstanceOf($class, ContainerHelper::getEncoder($type));
    }

    public function testItCanSetAValue()
    {
        ContainerHelper::set('pepito', 'gordito');

        self::assertEquals('gordito', ContainerHelper::get('pepito'));
    }

    public function testItCanSingleton()
    {
        ContainerHelper::singleton('exception', \Exception::class);

        self::assertInstanceOf(\Exception::class, ContainerHelper::get('exception'));
        self::assertSame(ContainerHelper::get('exception'), ContainerHelper::get('exception'));
    }

    public function testItCanBind()
    {
        ContainerHelper::bind('exception', \Exception::class);

        self::assertInstanceOf(\Exception::class, ContainerHelper::get('exception'));
        self::assertNotSame(ContainerHelper::get('exception'), ContainerHelper::get('exception'));
    }

    public function testItCanOverrideBind()
    {
        ContainerHelper::bind('exception', Iso8583Message::class);
        ContainerHelper::bind('exception', \Exception::class);

        self::assertInstanceOf(\Exception::class, ContainerHelper::get('exception'));
        self::assertNotSame(ContainerHelper::get('exception'), ContainerHelper::get('exception'));
    }

    public function testItCanSetAType()
    {
        ContainerHelper::setType('pepito', Numeric::class);

        self::assertInstanceOf(Numeric::class, ContainerHelper::getType('pepito'));
    }

    public function testItCanNotSetATypeWithoutTypeContract()
    {
        $this->expectException(ContainerException::class);
        $this->expectExceptionMessage('Error setting type "pepito": The class "LauanaOh\Iso8583\Iso8583Message" does not implement LauanaOh\Iso8583\Contracts\TypeContract interface.');

        ContainerHelper::setType('pepito', Iso8583Message::class);
    }

    public function testItCanSetAEncoder()
    {
        ContainerHelper::setEncoder('pepito', ASCII::class);

        self::assertInstanceOf(ASCII::class, ContainerHelper::getEncoder('pepito'));
    }

    public function testItCanNotSetAEncoderWithoutEncoderContract()
    {
        $this->expectException(ContainerException::class);
        $this->expectExceptionMessage('Error setting encoder "pepito": The class "LauanaOh\Iso8583\Iso8583Message" does not implement LauanaOh\Iso8583\Contracts\EncoderContract interface.');

        ContainerHelper::setEncoder('pepito', Iso8583Message::class);
    }

    public function testItCanSetALength()
    {
        ContainerHelper::setLength('....', LLVAR::class);

        self::assertInstanceOf(LLVAR::class, ContainerHelper::getLength(strlen('....')));
    }

    public function testItCanNotSetALengthWithoutLengthContract()
    {
        $this->expectException(ContainerException::class);
        $this->expectExceptionMessage('Error setting length "....": The class "LauanaOh\Iso8583\Iso8583Message" does not implement LauanaOh\Iso8583\Contracts\LengthContract interface.');

        ContainerHelper::setLength('....', Iso8583Message::class);
    }
}