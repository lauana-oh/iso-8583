<?php

namespace Tests\Feature\Unpack;

use LauanaOh\Iso8583\Exceptions\DecodeException;
use LauanaOh\Iso8583\Exceptions\InvalidValueException;
use Tests\Concerns\HasFieldsDataProvider;
use Tests\TestCase;

class DecodeTest extends TestCase
{
    use HasFieldsDataProvider;

    public function testItCanDecodeAMessage()
    {
        $byteMessage = '020070200000020000001641107600000000080000000000000068000001233030';

        $this->assertEquals($this->fieldsData, iso8583_decode($byteMessage));
    }

    public function testItCanDecodeAMessageWithCustomSpecification()
    {
        $byteMessage = '303230307020000002000002313634313130373630303030303030303038303030303030303030303030303036383030303030313233303030313348656C6C6F2C20776F726C6421';

        $specification = [
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

        $this->assertEquals($this->fieldsData, iso8583_decode($byteMessage, $specification));
    }

    public function testItCanDecodeAMessageWithSecondBitmap()
    {
        $byteMessage = '0200F0200080020000000000000000000200164110760000000008000000000000006800000123813030001348656C6C6F2C20776F726C6421';

        $this->fieldsData[25] = '81';
        $this->fieldsData[119] = 'Hello, world!';

        $this->assertEquals($this->fieldsData, iso8583_decode($byteMessage));
    }

    public function testItCanDecodeAMessageWithThirdBitmap()
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

        $this->assertEquals($this->fieldsData, iso8583_decode($byteMessage, $settings));
    }

    public function testItCanDecodeWithCustomPaddingSetting()
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
            ],
        ];

        $this->fieldsData[2] = '411076000000008';

        $this->assertEquals($this->fieldsData, iso8583_decode($byteMessage, $specification));
    }

    public function testItCanDecodeWithCustomPaddingRightSetting()
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

        $this->assertEquals($this->fieldsData, iso8583_decode($byteMessage, $specification));
    }

    /**
     * @dataProvider dataType
     */
    public function testItCanNotDecodeDueInvalidDataType(string $type)
    {
        $byteMessage = '0200702000000200000061626331322A0000000000000068000001233030';

        $specification['fields'] = [
            2 => [
                'type' => $type,
                'encode' => 'ascii',
                'length' => 6,
            ],
        ];

        $this->expectException(\LauanaOh\Iso8583\Exceptions\DecodeException::class);
        $this->expectExceptionMessage('[Field 2]: value "abc12*" is not valid type "'.$type.'".');

        iso8583_decode($byteMessage, $specification);
    }

    /**
     * @dataProvider invalidVariableLength
     */
    public function testItCanNotDecodeDueInvalidVariableLength(string $type, int $size, string $message)
    {
        $length = str_pad('16', strlen($type) % 2 == 0 ? strlen($type) : strlen($type) + 1, '0', STR_PAD_LEFT);
        $byteMessage = '02007020000002000000'.$length.'41107600000000080000000000000068000001233030';

        $specification['fields'] = [
            2 => [
                'type' => 'n'.$type,
                'encode' => 'bcd',
                'length' => $size,
            ],
        ];

        $this->expectException(DecodeException::class);
        $this->expectExceptionMessage(sprintf($message, 2, $this->fieldsData[2]));

        iso8583_decode($byteMessage, $specification);
    }

    public function testItCanNotDecodeDueMessageStreamExausted()
    {
        $byteMessage = '3032303070200000020000023136343131303736303030303030303030383030303';

        $this->expectException(DecodeException::class);
        $this->expectExceptionMessage('[Field 55]: The message stream is exhaust');

        iso8583_decode($byteMessage);
    }
}
