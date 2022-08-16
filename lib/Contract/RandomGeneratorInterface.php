<?php


namespace Squash\Contract;

interface RandomGeneratorInterface
{
    public function generateString(int $length): string;
}