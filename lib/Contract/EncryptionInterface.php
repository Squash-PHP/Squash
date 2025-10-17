<?php


namespace Squash\Contract;

interface EncryptionInterface
{
    public function encrypt(string $data, string $key): string;

    public function decrypt(string $data, string $key): string;
}
