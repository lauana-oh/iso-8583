<?php

namespace Tests;

use PHPUnit\Framework\TestCase as PHPUnitTestCase;

class TestCase extends PHPUnitTestCase
{
    protected array $fieldsData;

    protected function setUp(): void
    {
        parent::setUp();

        $this->fieldsData = [
            0 => '0200',
            2 => '4110760000000008',
            3 => '000000',
            4 => '000000006800',
            11 => '000123',
            39 => '00',
        ];
    }
}
