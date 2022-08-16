<?php


namespace Squash\Contract;

interface NumberFormatterInterface
{
    public function format(float $number): string;

    public function round(float $number, int $decimals): string;
}