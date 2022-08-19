<?php


namespace Squash\Conversion\Legacy;

use OutOfRangeException;
use Squash\Conversion\Unit;
use Squash\Contract\ConverterInterface;
use SquashConversionsBiByte;


final class BiByteConverter implements ConverterInterface
{
    private Unit $from;
    private string $to;
    private SquashConversionsBiByte $legacy;

    public function __construct(SquashConversionsBiByte $legacy)
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

    /**
     * Legacy class does not support conversion to `bibytes`. Shame.
     *
     * @return Unit
     */
    public function convert(): Unit
    {
        switch ($this->from->unit) {
            case Unit::KILOBYTE:
                $result = $this->legacy->kibibyte($this->from->value, $this->to);
                break;
            case Unit::MEGABYTE:
                $result = $this->legacy->mebibyte($this->from->value, $this->to);
                break;
            case Unit::GIGABYTE:
                $result = $this->legacy->gibibyte($this->from->value, $this->to);
                break;
            case Unit::TERABYTE:
                $result = $this->legacy->tebibyte($this->from->value, $this->to);
                break;
            case Unit::PETABYTE:
                $result = $this->legacy->pebibyte($this->from->value, $this->to);
                break;
            default:
                throw new OutOfRangeException('Unknown conversion unit.');
        }

        return new Unit($result, $this->to);
    }
}