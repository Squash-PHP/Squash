<?php

namespace Squash\Api\Discord;

use Squash\Contract\Api\DiscordEndpointInterface;

final class DiscordEndpointController implements DiscordEndpointInterface {
    public function sendWebhookMessage(string $message, string $webhookUrl): void {
        $handle = curl_init();
        curl_setopt_array($handle, [
                CURLOPT_URL            => $webhookUrl,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_MAXREDIRS      => 10,
                CURLOPT_TIMEOUT        => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST  => "POST",
                CURLOPT_POSTFIELDS     => json_encode(['content' => $message]),
                CURLOPT_HTTPHEADER     => [
                        'Content-Type: application/json',
                ],
        ]);
        curl_exec($handle);
        curl_close($handle);
    }
}