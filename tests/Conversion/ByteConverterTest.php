<?php


namespace Squash\Conversion;


use OutOfRangeException;
use PHPUnit\Framework\TestCase;


class ByteConverterTest extends TestCase
{
    /**
     * @dataProvider units
     */
    public function testConvert(Unit $from, string $to, Unit $expected): void
    {
        $byteConverter = new ByteConverter();
        $result = $byteConverter->from($from)->to($to)->convert();

        $this->assertSame(
            [$expected->value, $expected->unit],
            [$result->value, $result->unit]
        );
    }

    public function testConvertNonExistentType(): void
    {
        $byteConverter = new ByteConverter();
        $this->expectException(OutOfRangeException::class);
        $byteConverter->from(Unit::byte(1))->to('kilobyte')->convert();
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
                Unit::byte(1000)
            ],
            [
                Unit::megabyte(1),
                Unit::BYTE,
                Unit::byte(1000 * 1000)
            ],
            [
                Unit::gigabyte(1),
                Unit::BYTE,
                Unit::byte(1000 * 1000 * 1000)
            ],
            [
                Unit::terabyte(1),
                Unit::BYTE,
                Unit::byte(1000 * 1000 * 1000 * 1000)
            ],
            [
                Unit::petabyte(1),
                Unit::BYTE,
                Unit::byte(1000 * 1000 * 1000 * 1000 * 1000)
            ],
            [
                Unit::byte(1),
                Unit::BYTE,
                Unit::byte(1),
            ],
            [
                Unit::byte(1000),
                Unit::KILOBYTE,
                Unit::kilobyte(1),
            ],
            [
                Unit::byte(1000 * 1000),
                Unit::MEGABYTE,
                Unit::megabyte(1),
            ],
            [
                Unit::byte(1000 * 1000 * 1000),
                Unit::GIGABYTE,
                Unit::gigabyte(1),
            ],
            [
                Unit::byte(1000 * 1000 * 1000 * 1000),
                Unit::TERABYTE,
                Unit::terabyte(1),
            ],
            [
                Unit::byte(1000 * 1000 * 1000 * 1000 * 1000),
                Unit::PETABYTE,
                Unit::petabyte(1),
            ],
        ];
    }
}
