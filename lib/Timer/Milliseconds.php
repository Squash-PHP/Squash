<?php


namespace Squash\Timer;


use OutOfBoundsException;
use Squash\Contract\TimerInterface;


final class Milliseconds implements TimerInterface
{
    public function wait(int $period): void
    {
        if ($period < 1) {
            throw new OutOfBoundsException('Cannot use non-positive numbers as milliseconds.');
        }
        usleep($period * 1000);
    }
}