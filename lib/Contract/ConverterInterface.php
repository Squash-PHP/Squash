<?php


namespace Squash\Contract;

use Squash\Conversion\Unit;


interface ConverterInterface
{
    public function from(Unit $from): ConverterInterface;

    public function to(string $to): ConverterInterface;

    public function convert(): Unit;
}