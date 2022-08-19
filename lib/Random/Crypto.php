<?php


namespace Squash\Random;

use Exception;
use Squash\Contract\RandomGeneratorInterface;


final class Crypto implements RandomGeneratorInterface
{
    /**
     * @throws Exception
     */
    public function generateString(int $length): string
    {
        $bytes = (int) ($length / 2);
        if ($length % 2 != 0) {
            $bytes += 1;
        }

        $string = bin2hex(random_bytes($bytes));

        return substr($string, 0, $length);
    }
}