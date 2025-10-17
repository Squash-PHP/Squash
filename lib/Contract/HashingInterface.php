<?php


namespace Squash\Contract;

interface HashingInterface
{
    public function hash(string $data): string;

    public function verify(string $data, string $hash): bool;
}
