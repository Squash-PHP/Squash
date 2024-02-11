<?php


namespace Squash\Contract\Api;

use Squash\Contract\Api\Generate\Request;
use Squash\Contract\Api\Generate\Response;

interface OllamaEndpointInterface
{
    public function generate(Request $request): Response;
    public function loadModel(string $model, string $address): bool;
    public function chat(string $model, string $address, array $messages, ?string $format, ?array $options, ?string $keep_alive): Response;
}
