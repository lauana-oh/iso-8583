<?php

namespace Tests\Unit;

use LauanaOh\Iso8583\Entities\ByteStream;
use PHPUnit\Framework\TestCase;

class ByteStreamTest extends TestCase
{
    public function testItCanGetAndMoveCursor()
    {
        $byteStream = new ByteStream('1234567890');

        $this->assertEquals('1234', $byteStream->getAndMoveCursor(4));
        $this->assertEquals('567890', $byteStream->getCurrentBytes());
    }

    public function testItCanGetNewByteStreamAndMoveCursor()
    {
        $byteStream = new ByteStream('1234567890');

        $newByteStream = $byteStream->getNewByteStreamAndMoveCursor(4);

        $this->assertInstanceOf(ByteStream::class, $newByteStream);
        $this->assertEquals('1234', $newByteStream->getCurrentBytes());
        $this->assertEquals('567890', $byteStream->getCurrentBytes());
    }

    public function testItCanConcatMessage()
    {
        $byteStream = new ByteStream('1234567890');

        $byteStream->concat('abc');

        $this->assertEquals('1234567890abc', $byteStream->getCurrentBytes());
    }

    public function testItCanPrependMessage()
    {
        $byteStream = new ByteStream('1234567890');

        $byteStream->prepend('abc');

        $this->assertEquals('abc1234567890', $byteStream->getCurrentBytes());
    }

    public function testItCanUseAsAString()
    {
        $byteStream = new ByteStream('1234567890');

        $this->assertEquals('1234567890', (string) $byteStream);
        $this->assertEquals(10, strlen($byteStream));
    }
}
