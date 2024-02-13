<?php

namespace Squash\Number;

use Squash\Contract\LocaliseInterface;

final class LocaliseController implements LocaliseInterface
{

    /**
     * Localises a number based on the provided locale.
     *
     * @param mixed  $number The number to localise.
     * @param string $locale The locale code (e.g., 'en_US', 'fr_FR').
     *
     * @return string Returns the localised number.
     */
    public function localiseNumber($number, string $locale): string
    {
        $formatter = new \NumberFormatter($locale, \NumberFormatter::DECIMAL);
        return $formatter->format($number);
    }

    /**
     * Localises a date based on the provided locale.
     *
     * @param mixed  $date   The date to localise. This can be a string, a timestamp, or an instance of DateTime.
     * @param string $locale The locale code (e.g., 'en_US', 'fr_FR').
     *
     * @return string Returns the localised date.
     */
    public function localiseTime($time, string $locale): string
    {
        $formatter = new \IntlDateFormatter(
            $locale,
            \IntlDateFormatter::NONE,
            \IntlDateFormatter::SHORT
        );
        return $formatter->format($time);
    }

    /**
     * Localises a date based on the provided locale.
     *
     * @param mixed  $date   The date to localise. This can be a string, a timestamp, or an instance of DateTime.
     * @param string $locale The locale code (e.g., 'en_US', 'fr_FR').
     *
     * @return string Returns the localised date.
     */
    public function localiseDate($date, string $locale): string
    {
        $formatter = new \IntlDateFormatter(
            $locale,
            \IntlDateFormatter::SHORT,
            \IntlDateFormatter::NONE
        );
        return $formatter->format($date);
    }

    /**
     * Localises a currency amount based on the provided locale.
     *
     * @param float  $amount   The amount to localise.
     * @param string $currency The currency code (e.g., 'USD', 'EUR').
     * @param string $locale   The locale code (e.g., 'en_US', 'fr_FR').
     *
     * @return string Returns the localised currency amount.
     */
    public function localiseCurrency(float $amount, string $currency, string $locale): string
    {
        $formatter = new \NumberFormatter($locale, \NumberFormatter::CURRENCY);
        return $formatter->formatCurrency($amount, $currency);
    }
}
