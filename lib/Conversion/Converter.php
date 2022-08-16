<?php


namespace Squash\Conversion;


use Squash\Contract\ConverterInterface;


abstract class Converter implements ConverterInterface
{
    protected string $to;
    protected Unit $from;

    final public function from(Unit $from): ConverterInterface
    {
        $this->from = $from;
        return $this;
    }

    final public function to(string $to): ConverterInterface
    {
        $this->to = $to;
        return $this;
    }

    final public function convert(): Unit
    {
        $units = array_values(Unit::units());

        $fromIndex = array_search($this->from->unit, $units);
        $toIndex = array_search($this->to, $units);

        $result = $this->from->value;

        $modifier = ($fromIndex > $toIndex) ? $this->getPositiveMutator() : $this->getNegativeMutator();

        for ($i = 0; $i < abs($toIndex - $fromIndex); $i++) {
            $result = $modifier($result);
        }

        return new Unit($result, $this->to);
    }

    abstract protected function getPositiveMutator(): callable;

    abstract protected function getNegativeMutator(): callable;
}