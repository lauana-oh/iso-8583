<?php

namespace Tests\Feature\Pack;

use LauanaOh\Iso8583\Exceptions\InvalidValueException;
use Tests\Concerns\HasFieldsDataProvider;
use Tests\TestCase;

class EncodeTest extends TestCase
{
    use HasFieldsDataProvider;

    public function testItCanEncodeAMessage()
    {
        $byteMessage = '020070200000020000001641107600000000080000000000000068000001233030';

        $this->assertEquals($byteMessage, iso8583_encode($this->fieldsData));
    }

    public function testItCanEncodeAMessageWithCustomSpecification()
    {
        $byteMessage = '303230307020000002000002313634313130373630303030303030303038303030303030303030303030303036383030303030313233303030313348656C6C6F2C20776F726C6421';

        $settings = [
            'fields' => [
                0 => [
                    'type' => 'n',
                    'length' => 4,
                    'encode' => 'ascii',
                ],
                2 => [
                    'type' => 'n..',
                    'encode' => 'ascii, ascii',
                    'length' => 19,
                ],
                3 => [
                    'type' => 'n',
                    'encode' => 'ascii',
                    'length' => 6,
                ],
                4 => [
                    'type' => 'n',
                    'encode' => 'ascii',
                    'length' => 12,
                ],
                11 => [
                    'type' => 'n',
                    'encode' => 'ascii',
                    'length' => 6,
                ],
                39 => [
                    'type' => 'an',
                    'encode' => 'ascii',
                    'length' => 2,
                ],
                63 => [
                    'type' => 'ans...',
                    'encode' => 'ascii,ascii',
                    'length' => 999,
                ],
            ],
        ];

        $this->fieldsData[63] = 'Hello, world!';

        $this->assertEquals($byteMessage, iso8583_encode($this->fieldsData, $settings));
    }

    public function testItCanEncodeAMessageWithSecondBitmap()
    {
        $byteMessage = '0200F0200080020000000000000000000200164110760000000008000000000000006800000123813030001348656C6C6F2C20776F726C6421';

        $this->fieldsData[25] = '81';
        $this->fieldsData[119] = 'Hello, world!';

        $this->assertEquals($byteMessage, iso8583_encode($this->fieldsData));
    }

    public function testItCanEncodeAMessageWithThirdBitmap()
    {
        $byteMessage = '0200F02000800200000080000000000002001000000000000000164110760000000008000000000000006800000123813030001348656C6C6F2C20776F726C642106123456';

        $settings = [
            'fields' => [
                132 => [
                    'type' => 'n..',
                    'encode' => 'bcd',
                    'length' => 16,
                ],
            ],
        ];

        $this->fieldsData[25] = '81';
        $this->fieldsData[119] = 'Hello, world!';
        $this->fieldsData[132] = '123456';

        $this->assertEquals($byteMessage, iso8583_encode($this->fieldsData, $settings));
    }

    public function testItCanEncodeWithCustomPaddingSetting()
    {
        $byteMessage = '0200702000000200000015F4110760000000080000000000000068000001233030';

        $specification = [
            'fields' => [
                2 => [
                    'type' => 'n..',
                    'encode' => 'bcd',
                    'length' => 19,
                    'padding' => [
                        'value' => 'F',
                    ],
                ],
                4 => [
                    'type' => 'n',
                    'encode' => 'bcd',
                    'length' => 12,
                    'padding' => [
                        'length' => 12,
                    ],
                ],
            ],
        ];

        $this->fieldsData[2] = '411076000000008';
        $this->fieldsData[4] = '6800';

        $this->assertEquals($byteMessage, iso8583_encode($this->fieldsData, $specification));
    }

    public function testItCanEncodeWithCustomPaddingRightSetting()
    {
        $byteMessage = '0200702000000200000015411076000000008F0000000000000068000001233030';

        $specification = [
            'fields' => [
                2 => [
                    'type' => 'n..',
                    'encode' => 'bcd, bcd',
                    'length' => 19,
                    'padding' => [
                        'value' => 'F',
                        'position' => STR_PAD_RIGHT,
                    ],
                ],
            ],
        ];

        $this->fieldsData[2] = '411076000000008';

        $this->assertEquals($byteMessage, iso8583_encode($this->fieldsData, $specification));
    }

    /**
     * @dataProvider dataType
     */
    public function testItCanNotEncodeDueInvalidDataType(string $type)
    {
        $specification['fields'] = [
            2 => [
                'type' => $type,
                'encode' => 'bcd',
                'length' => 6,
            ],
        ];

        $this->fieldsData[2] = 'abc12*';

        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage('[Field 2]: value "abc12*" is not valid type "'.$type.'".');

        iso8583_encode($this->fieldsData, $specification);
    }

    /**
     * @dataProvider invalidFixedLength
     */
    public function testItCanNotEncodeDueInvalidFixedLength(string $type, int $length, string $message)
    {
        $specification['fields'] = [
            2 => [
                'type' => 'n'.$type,
                'encode' => 'bcd',
                'length' => $length,
            ],
        ];

        $this->fieldsData[2] = '12345678';

        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage(sprintf($message, 2, $this->fieldsData[2]));

        iso8583_encode($this->fieldsData, $specification);
    }

    /**
     * @dataProvider invalidVariableLength
     */
    public function testItCanNotEncodeDueInvalidVariableLength(string $type, int $length, string $message)
    {
        $specification['fields'] = [
            2 => [
                'type' => 'n'.$type,
                'encode' => 'bcd',
                'length' => $length,
            ],
        ];

        $this->fieldsData[2] = '12345678';

        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage(sprintf($message, 2, $this->fieldsData[2]));

        iso8583_encode($this->fieldsData, $specification);
    }
}
