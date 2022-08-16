<?php


namespace Squash\Conversion;


final class ByteConverter extends Converter
{
    protected function getPositiveMutator(): callable
    {
        return static function (int $value): int {
            return (int) ($value * 1000);
        };
    }

    protected function getNegativeMutator(): callable
    {
        return static function (int $value): int {
            return (int) ($value / 1000);
        };
    }
}