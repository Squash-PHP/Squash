<?php


namespace Squash\Number;


use InvalidArgumentException;
use PHPUnit\Framework\TestCase;


class CalculatorTest extends TestCase
{
    /**
     * @dataProvider calculations
     */
    public function testCalculate(int $left, string $operator, int $right, int $expected): void
    {
        $calculator = new Calculator();
        $result = $calculator->calculate($left, $operator, $right);
        $this->assertSame($expected, $result);
    }

    public function testCalculateArgumentCountError(): void
    {
        $calculator = new Calculator();
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Argument count must be exactly three.');
        $calculator->calculate(1, '+', 3, '-', 2);
    }

    public function testCalculateUnknownOperator(): void
    {
        $calculator = new Calculator();
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Unknown operator.');
        $calculator->calculate(1, '^', 2);
    }

    public function calculations(): array
    {
        return [
            [2, '+', 2, 4],
            [2, '-', 2, 0],
            [2, '*', 2, 4],
            [2, '/', 2, 1],
        ];
    }
}
