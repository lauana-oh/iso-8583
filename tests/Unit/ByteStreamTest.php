<?php

namespace Tests\Unit;

use LauanaOh\Iso8583\Entities\ByteStream;
use PHPUnit\Framework\TestCase;

class ByteStreamTest extends TestCase
{
    public function testItCanGetAndMoveCursor()
    {
        $byteStream = new ByteStream('1234567890');

        self::assertEquals('1234', $byteStream->getAndMoveCursor(4));
        self::assertEquals('567890', $byteStream->getCurrentBytes());
    }

    public function testItCanGetNewByteStreamAndMoveCursor()
    {
        $byteStream = new ByteStream('1234567890');

        $newByteStream = $byteStream->getNewByteStreamAndMoveCursor(4);

        self::assertInstanceOf(ByteStream::class, $newByteStream);
        self::assertEquals('1234', $newByteStream->getCurrentBytes());
        self::assertEquals('567890', $byteStream->getCurrentBytes());
    }

    public function testItCanConcatMessage()
    {
        $byteStream = new ByteStream('1234567890');

        $byteStream->concat('abc');

        self::assertEquals('1234567890abc', $byteStream->getCurrentBytes());
    }

    public function testItCanPrependMessage()
    {
        $byteStream = new ByteStream('1234567890');

        $byteStream->prepend('abc');

        self::assertEquals('abc1234567890', $byteStream->getCurrentBytes());
    }

    public function testItCanUseAsAString()
    {
        $byteStream = new ByteStream('1234567890');

        self::assertEquals('1234567890', (string) $byteStream);
        self::assertEquals(10, strlen($byteStream));
    }
}
