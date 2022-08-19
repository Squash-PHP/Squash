<?php


namespace Squash\Conversion;

use PHPUnit\Framework\TestCase;


class BiByteConverterTest extends TestCase
{
    /**
     * @dataProvider units
     */
    public function testConvert(Unit $from, string $to, Unit $expected): void
    {
        $converter = new BiByteConverter();
        $result = $converter->from($from)->to($to)->convert();
        $this->assertSame([$expected->unit, $expected->value], [$result->unit, $result->value]);
    }
    
    public function units(): array
    {
        return [
            [
                Unit::byte(1),
                Unit::BYTE,
                Unit::byte(1)
            ],
            [
                Unit::kilobyte(1),
                Unit::BYTE,
                Unit::byte(1024)
            ],
            [
                Unit::megabyte(1),
                Unit::BYTE,
                Unit::byte(1024 * 1024)
            ],
            [
                Unit::gigabyte(1),
                Unit::BYTE,
                Unit::byte(1024 * 1024 * 1024)
            ],
            [
                Unit::terabyte(1),
                Unit::BYTE,
                Unit::byte(1024 * 1024 * 1024 * 1024)
            ],
            [
                Unit::petabyte(1),
                Unit::BYTE,
                Unit::byte(1024 * 1024 * 1024 * 1024 * 1024)
            ],
            [
                Unit::byte(1),
                Unit::BYTE,
                Unit::byte(1),
            ],
            [
                Unit::byte(1024),
                Unit::KILOBYTE,
                Unit::kilobyte(1),
            ],
            [
                Unit::byte(1024 * 1024),
                Unit::MEGABYTE,
                Unit::megabyte(1),
            ],
            [
                Unit::byte(1024 * 1024 * 1024),
                Unit::GIGABYTE,
                Unit::gigabyte(1),
            ],
            [
                Unit::byte(1024 * 1024 * 1024 * 1024),
                Unit::TERABYTE,
                Unit::terabyte(1),
            ],
            [
                Unit::byte(1024 * 1024 * 1024 * 1024 * 1024),
                Unit::PETABYTE,
                Unit::petabyte(1),
            ]
        ];
    }
}