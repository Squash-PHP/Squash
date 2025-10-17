<?php


namespace Squash\Contract;

interface ErrorHandlerInterface
{
    public function handleError(int $errno, string $errstr, string $errfile, int $errline): bool;

    public function handleException(\Throwable $exception): void;

    public function register(): void;
}
