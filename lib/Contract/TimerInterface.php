<?php


namespace Squash\Contract;

interface TimerInterface
{
    public function wait(int $period): void;
}