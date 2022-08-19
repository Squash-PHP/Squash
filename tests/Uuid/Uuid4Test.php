<?php


namespace Squash\Uuid;


use PHPUnit\Framework\TestCase;


class Uuid4Test extends TestCase
{
    public function testGenerateUuid(): void
    {
        $uuid = new Uuid4();
        $result = $uuid->generateUuid();
        $parts = explode('-', $result);
        $this->assertStringStartsWith('4', $parts[2]);
        $this->assertMatchesRegularExpression('/^[89ab][0-9A-z]{3}/u', $parts[3]);
    }
}
