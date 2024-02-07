<?php


namespace Squash\Contract;

interface ApiInterface
{
    public function generate(string $address, string $prompt, string $model, string $images = null, string $format = null, string $system = null, string $template = null, string $context = null, bool $raw = false, string $stayalive = '30s'): object;
}