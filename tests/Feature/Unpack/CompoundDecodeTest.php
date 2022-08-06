<?php

namespace Tests\Feature\Unpack;

use LauanaOh\Iso8583\Builders\FixedCompoundBuilder;
use Tests\TestCase;

class CompoundDecodeTest extends TestCase
{
    public function testItCanDecodeAValueCompoundMessage()
    {
        $byteMessage = '0200702000000200000216411076000000000800000000000000680000012330301302303030303030313030303030';

        $this->fieldsData[63] = [
            'totalSales' => '02',
            'totalSalesAmount' => '000000100000'
        ];

        $specification['fields'] = [
            63 => [
                'type' => 'n..',
                'encode' => 'bcd, ascii',
                'length' => 14,
                'compound' => [
                    'builder' => FixedCompoundBuilder::class,
                    'fields' => [
                        'totalSales' => [
                            'type' => 'n',
                            'encode' => 'bcd',
                            'length' => 2,
                        ],
                        'totalSalesAmount' => [
                            'type' => 'n',
                            'encode' => 'ascii',
                            'length' => 12,
                        ],
                    ],
                ],
            ],
        ];

        self::assertEquals($this->fieldsData, iso8583_decode($byteMessage, $specification));
    }

    public function testItCanDecodeALengthValueCompoundMessage()
    {
        $byteMessage = '02007020000002000002164110760000000008000000000000006800000123303015020212303030303030313030303030';

        $this->fieldsData[63] = [
            'totalSales' => '02',
            'totalSalesAmount' => '000000100000'
        ];

        $specification['fields'] = [
            63 => [
                'type' => 'n..',
                'encode' => 'bcd, ascii',
                'length' => 99,
                'compound' => [
                    'builder' => FixedCompoundBuilder::class,
                    'fields' => [
                        'totalSales' => [
                            'type' => 'n..',
                            'encode' => 'bcd',
                            'length' => 2,
                        ],
                        'totalSalesAmount' => [
                            'type' => 'n..',
                            'encode' => 'bcd, ascii',
                            'length' => 12,
                        ],
                    ],
                ],
            ],
        ];

        self::assertEquals($this->fieldsData, iso8583_decode($byteMessage, $specification));
    }
}