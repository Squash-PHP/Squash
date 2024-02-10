<?php


namespace Squash\Contract\Api;

interface DiscordEndpointInterface
{
    public function sendWebhookMessage(string $message, string $webhookUrl): void;
}
