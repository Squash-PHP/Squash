<?php


namespace Squash\Contract\Api;

use Squash\Contract\Api\Generate\Request;
use Squash\Contract\Api\Generate\Response;

interface OllamaEndpointInterface
{
    public function generate(Request $request): Response;
}