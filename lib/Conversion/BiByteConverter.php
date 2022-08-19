<?php


namespace Squash\Conversion;


final class BiByteConverter extends Converter
{
    protected function getPositiveMutator(): callable
    {
        return static function (int $value): int {
            return (int) ($value * 1024);
        };
    }

    protected function getNegativeMutator(): callable
    {
        return static function (int $value): int {
            return (int) ($value / 1024);
        };
    }
}