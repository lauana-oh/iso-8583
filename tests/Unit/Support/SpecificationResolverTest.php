<?php

namespace Tests\Unit\Support;

use LauanaOh\Iso8583\Entities\Padding;
use LauanaOh\Iso8583\Support\SpecificationResolver;
use PHPUnit\Framework\TestCase;
use Symfony\Component\OptionsResolver\Exception\InvalidOptionsException;

class SpecificationResolverTest extends TestCase
{
    protected array $settings;
    protected SpecificationResolver $resolver;

    protected function setUp(): void
    {
        parent::setUp();

        $this->settings = [
            'fields' => [
                0 => [
                    'type' => 'n',
                    'length' => 4,
                    'encode' => ['bcd'],
                ],
            ],
        ];

        $this->resolver = new SpecificationResolver();
    }

    public function testItCanResolveOverrideDefaultValue()
    {
        self::assertFalse($this->resolver->resolveSettings($this->settings)['override']);
    }

    public function testItValidatesOverrideIsBoolean()
    {
        $this->expectException(InvalidOptionsException::class);
        $this->expectExceptionMessage('The option "override" with value "bla" is expected to be of type "bool", but is of type "string".');

        $this->settings['override'] = 'bla';

        $this->resolver->resolveSettings($this->settings);
    }

    public function testItCanResolveFieldWithFixedLength()
    {
        $field = $this->resolver->resolveSettings($this->settings)['fields'][0];

        self::assertEquals(['value' => 'n', 'length' => 0], $field['type']);
        self::assertEquals(4, $field['length']);
        self::assertEquals(['value' => 'bcd', 'length' => 'bcd'], $field['encode']);
    }

    public function testItCanResolveFieldWithVariableLength()
    {
        $this->settings['fields'][0]['type'] = 'n..';
        $this->settings['fields'][0]['encode'] = ['bcd'];

        $field = $this->resolver->resolveSettings($this->settings)['fields'][0];

        self::assertEquals(['value' => 'n', 'length' => 2], $field['type']);
        self::assertEquals(4, $field['length']);
        self::assertEquals(['value' => 'bcd', 'length' => 'bcd'], $field['encode']);
    }

    public function testItCanResolveFieldWithVariableLengthAndDifferentEncode()
    {
        $this->settings['fields'][0]['type'] = 'n..';
        $this->settings['fields'][0]['encode'] = ['bcd', 'ascii'];

        $field = $this->resolver->resolveSettings($this->settings)['fields'][0];

        self::assertEquals(['value' => 'n', 'length' => 2], $field['type']);
        self::assertEquals(4, $field['length']);
        self::assertEquals(['value' => 'ascii', 'length' => 'bcd'], $field['encode']);
    }

    public function testItCanResolveFieldDefaultPadding()
    {
        $field = $this->resolver->resolveSettings($this->settings)['fields'][0];

        self::assertEquals(Padding::DEFAULT_POSITION, $field['padding']['position']);
        self::assertEquals(Padding::DEFAULT_PAD_STRING, $field['padding']['value']);
        self::assertEquals(0, $field['padding']['length']);
    }

    public function testItValidatesFieldPaddingPositionIsValid()
    {
        $this->expectException(InvalidOptionsException::class);
        $this->expectExceptionMessage('The option "fields[padding][position]" with value "r" is invalid. Accepted values are: STR_PAD_LEFT (0), STR_PAD_RIGHT (1).');

        $this->settings['fields'][0]['padding']['position'] = 'r';

        $this->resolver->resolveSettings($this->settings);
    }

    public function testItValidatesFieldPaddingValueIsAString()
    {
        $this->expectException(InvalidOptionsException::class);
        $this->expectExceptionMessage('The option "fields[padding][value]" with value array is expected to be of type "string", but is of type "array".');

        $this->settings['fields'][0]['padding']['value'] = ['r'];

        $this->resolver->resolveSettings($this->settings);
    }

    public function testItValidatesFieldPaddingValueIsAInt()
    {
        $this->expectException(InvalidOptionsException::class);
        $this->expectExceptionMessage('The option "fields[padding][length]" with value "r" is expected to be of type "int", but is of type "string".');

        $this->settings['fields'][0]['padding']['length'] = 'r';

        $this->resolver->resolveSettings($this->settings);
    }
}
