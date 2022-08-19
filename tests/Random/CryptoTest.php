<?php


namespace Squash\Random;


use PHPUnit\Framework\TestCase;


class CryptoTest extends TestCase
{
    public function testGenerateString()
    {
        $random = new Crypto();
        $this->assertSame(32, strlen($random->generateString(32)));
    }

    public function testGenerateStringOddLength()
    {
        $random = new Crypto();
        $this->assertSame(31, strlen($random->generateString(31)));
    }
}
