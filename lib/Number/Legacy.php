<?php


namespace Squash\Number;

use InvalidArgumentException;
use Squash\Contract\CalculatorInterface;
use Squash\Contract\NumberFormatterInterface;
use SquashNumber;


final class Legacy implements NumberFormatterInterface, CalculatorInterface
{
    private SquashNumber $legacy;

    public function __construct(SquashNumber $legacy)
    {
        $this->legacy = $legacy;
    }

    /**
     * Legacy follows some questionable logic. You can get `2 - 3 = 1`.
     *
     * @param ...$arguments
     *
     * @return float|int|void
     */
    public function calculate(...$arguments)
    {
        if (count($arguments) != 3) {
            throw new InvalidArgumentException('The amount of arguments must be exactly 3.');
        }

        list($left, $operator, $right) = $arguments;

        switch ($operator) {
            case '+':
                return $this->legacy->add($left, $right);
            case '-':
                return $this->legacy->subtract($left, $right);
            case '*':
                return $this->legacy->multiply($left, $right);
            case '/':
                return $this->legacy->divide($left, $right);
            default:
                throw new InvalidArgumentException('Unknown operator.');
        }
    }

    public function format(float $number): string
    {
        return $this->legacy->format($number);
    }

    public function round(float $number, int $decimals): string
    {
        return $this->legacy->round($number, $decimals);
    }
}