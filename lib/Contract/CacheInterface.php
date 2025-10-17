<?php


namespace Squash\Contract;

interface CacheInterface
{
    public function get(string $key, $default = null);

    public function set(string $key, $value, int $ttl = 0): bool;

    public function has(string $key): bool;

    public function delete(string $key): bool;

    public function clear(): bool;
}
