<?php


namespace Squash\Contract;

interface SessionInterface
{
    public function start(): bool;

    public function destroy(): bool;

    public function get(string $key, $default = null);

    public function set(string $key, $value): void;

    public function has(string $key): bool;

    public function remove(string $key): void;

    public function all(): array;

    public function clear(): void;
}
