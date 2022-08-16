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
        return bin2hex(random_bytes($length));
    }
}