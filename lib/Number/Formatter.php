<?php


namespace Squash\Number;

use Squash\Contract\NumberFormatterInterface;


/**
 * @codeCoverageIgnore No point in testing PHP function wraps.
 */
final class Formatter implements NumberFormatterInterface
{
    public function format(float $number): string
    {
        return number_format($number);
    }

    public function round(float $number, int $decimals): string
    {
        return number_format($number, $decimals, '.', '');
    }
}