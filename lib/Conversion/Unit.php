<?php


namespace Squash\Conversion;

use ReflectionClass;


final class Unit
{
    public const BYTE = 'b';
    public const KILOBYTE = 'kb';
    public const MEGABYTE = 'mb';
    public const GIGABYTE = 'gb';
    public const TERABYTE = 'tb';
    public const PETABYTE = 'pb';

    public int $value;
    public string $unit;

    public static function byte(int $value): Unit
    {
        return new Unit($value, Unit::BYTE);
    }

    public static function kilobyte(int $value): Unit
    {
        return new Unit($value, Unit::KILOBYTE);
    }

    public static function megabyte(int $value): Unit
    {
        return new Unit($value, Unit::MEGABYTE);
    }

    public static function gigabyte(int $value): Unit
    {
        return new Unit($value, Unit::GIGABYTE);
    }

    public static function terabyte(int $value): Unit
    {
        return new Unit($value, Unit::TERABYTE);
    }

    public static function petabyte(int $value): Unit
    {
        return new Unit($value, Unit::PETABYTE);
    }

    public static function units(): array
    {
        $reflection = new ReflectionClass(Unit::class);
        return $reflection->getConstants();
    }

    public function __construct(int $value, string $unit)
    {
        $this->value = $value;
        $this->unit = $unit;
    }

}