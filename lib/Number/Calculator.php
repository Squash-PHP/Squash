<?php


namespace Squash\Number;

use InvalidArgumentException;
use Squash\Contract\CalculatorInterface;


final class Calculator implements CalculatorInterface
{
    public function calculate(...$arguments)
    {
        if (count($arguments) != 3) {
            throw new InvalidArgumentException('Argument count must be exactly three.');
        }

        list($left, $operator, $right) = $arguments;

        switch ($operator) {
            case '+':
                return $left + $right;
            case '-':
                return $left - $right;
            case '*':
                return $left * $right;
            case '/':
                return $left / $right;
            default:
                throw new InvalidArgumentException('Unknown operator.');
        }
    }
}