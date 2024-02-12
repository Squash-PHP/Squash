<?php


namespace Squash\Contract\Api;

use Squash\Contract\Api\Generate\Request;
use Squash\Contract\Api\Generate\Response;

interface OllamaEndpointInterface
{
    public function generate(Request $request): Response;
    public function loadModel(string $model, string $address): bool;
    public function chat(string $model, string $address, array $messages, ?string $format, ?array $options, ?string $keep_alive): Response;
    public function createModel(string $address, string $name, ?string $modelfile, ?string $path):bool;
    public function listModels(string $address): object;
    public function showModelInfo(string $address, string $model): object;
    public function copyModel(string $address, string $source, string $destination): bool;
    public function deleteModel(string $address, string $name): bool;
    public function pullModel(string $address, string $name, ?string $insecure): bool;
    public function pushModel(string $address, string $name, ?string $insecure): bool;
    public function generateEmbeddings(string $address, string $model, string $prompt, ?array $options, ?string $keepAlive): object;
}
