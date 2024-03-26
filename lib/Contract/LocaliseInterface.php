<?php

namespace Squash\Contract;

interface LocaliseInterface
{
    public function localiseNumber($number, string $locale): string;
    public function localiseTime($time, string $locale): string;
    public function localiseDate($date, string $locale): string;
    public function localiseCurrency(float $amount, string $currency, string $locale): string;
}