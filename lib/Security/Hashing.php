<?php


namespace Squash\Security;

use Squash\Contract\HashingInterface;


final class Hashing implements HashingInterface
{
    public function hash(string $data): string
    {
        return password_hash($data, PASSWORD_DEFAULT);
    }

    public function verify(string $data, string $hash): bool
    {
        return password_verify($data, $hash);
    }
}
