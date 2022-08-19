<?php


namespace Squash\Conversion\Legacy;

use OutOfRangeException;
use Squash\Conversion\Unit;
use Squash\Contract\ConverterInterface;
use SquashConversionsByte;


final class ByteConverter implements ConverterInterface
{
    private SquashConversionsByte $legacy;
    private Unit $from;
    private string $to;

    public function __construct(SquashConversionsByte $legacy)
    {
        $this->legacy = $legacy;
    }

    public function from(Unit $from): ConverterInterface
    {
        $converter = clone $this;
        $converter->from = $from;

        return $converter;
    }

    public function to(string $to): ConverterInterface
    {
        $converter = clone $this;
        $converter->to = $to;

        return $converter;
    }

    public function convert(): Unit
    {
        switch ($this->from->unit) {
            case Unit::BYTE:
                $result = $this->legacy->bytes($this->from->value, $this->to);
                break;
            case Unit::KILOBYTE:
                $result = $this->legacy->kilobytes($this->from->value, $this->to);
                break;
            case Unit::MEGABYTE:
                $result = $this->legacy->megabytes($this->from->value, $this->to);
                break;
            case Unit::GIGABYTE:
                $result = $this->legacy->gigabytes($this->from->value, $this->to);
                break;
            case Unit::TERABYTE:
                $result = $this->legacy->terabytes($this->from->value, $this->to);
                break;
            case Unit::PETABYTE:
                $result = $this->legacy->petabytes($this->from->value, $this->to);
                break;
            default:
                throw new OutOfRangeException('Unknown conversion unit.');
        }

        return new Unit($result, $this->to);
    }
}