<?php

namespace Tests\Unit;

use Lauana\Iso\Support\SpecificationResolver;
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
        $this->settings['fields'][0]['encode'] = ['bcd', 'bcd'];

        $field = $this->resolver->resolveSettings($this->settings)['fields'][0];

        self::assertEquals(['value' => 'n', 'length' => 2], $field['type']);
        self::assertEquals(4, $field['length']);
        self::assertEquals(['value' => 'bcd', 'length' => 'bcd'], $field['encode']);
    }
}
