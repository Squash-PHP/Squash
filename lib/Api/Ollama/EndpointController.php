<?php

namespace Squash\Api\Ollama;

use DateTimeImmutable;
use Squash\Contract\Api\Generate\Request;
use Squash\Contract\Api\Generate\Response;
use Squash\Contract\Api\OllamaEndpointInterface;

final class EndpointController implements OllamaEndpointInterface {
    /**
     * Will use the Ollama API to generate a response.
     *
     * @param Request $request
     * @return object
     */
    public function generate(Request $request): Response {
        $handle = curl_init();
        $address = rtrim($request->address, '/');
        $requestBody = array_merge($request->toArray(), ['stream' => false]);

        curl_setopt_array($handle, [
                CURLOPT_URL            => "{$address}/api/generate",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_MAXREDIRS      => 10,
                CURLOPT_TIMEOUT        => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST  => "POST",
                CURLOPT_POSTFIELDS     => json_encode($requestBody),
                CURLOPT_HTTPHEADER     => [
                        'Content-Type: application/json',
                ],
        ]);
        $response = curl_exec($handle);
        curl_close($handle);

        $responseBody = json_decode($response, true);

        $createdAt = explode('.', $responseBody['created_at']);
        $createdAt = DateTimeImmutable::createFromFormat('Y-m-d\TH:i:s', $createdAt[0]);

        return new Response(
                $createdAt,
                $responseBody['total_duration'] ?? 0,
                $responseBody['load_duration'] ?? 0,
                $responseBody['prompt_eval_count'] ?? 0,
                $responseBody['prompt_eval_duration'] ?? 0,
                $responseBody['eval_count'] ?? 0,
                $responseBody['eval_duration'] ?? 0,
                $responseBody['context'] ?? '',
                $responseBody['response'] ?? '',
        );
    }
}
