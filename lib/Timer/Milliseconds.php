<?php


namespace Squash\Timer;


use Squash\Contract\TimerInterface;


final class Milliseconds implements TimerInterface
{
    public function wait(int $period): void
    {
        usleep($period * 1000);
    }
}