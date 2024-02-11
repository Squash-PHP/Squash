<?php

namespace Squash\Api\Ollama;

use DateTimeImmutable;
use Squash\Contract\Api\Generate\Request;
use Squash\Contract\Api\Generate\Response;
use Squash\Contract\Api\OllamaEndpointInterface;

final class OllamaEndpointController implements OllamaEndpointInterface
{
    /**
     * Will use the Ollama API to generate a response.
     *
     * @param Request $request
     * @return object
     */
    public function generate(Request $request): Response
    {
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
        if ($responseBody === null) {
            throw new \Exception('Failed to parse response from Ollama. CURL error: ' . curl_error($handle));
        }
        return new Response(
            $responseBody['created_at'],
            $responseBody['total_duration'] ?? 0,
            $responseBody['load_duration'] ?? 0,
            $responseBody['prompt_eval_count'] ?? 0,
            $responseBody['prompt_eval_duration'] ?? 0,
            $responseBody['eval_count'] ?? 0,
            $responseBody['eval_duration'] ?? 0,
            $responseBody['context'] ?? array(),
            $responseBody['response'] ?? '',
        );
    }

    /**
     * Loads a model to the Ollama API.
     *
     * @param string $model The name of the model to load.
     * @param string $address The address of the Ollama API.
     *
     * @return bool Returns true if the model was successfully loaded, false otherwise.
     *
     * @throws \Exception If there is an error executing the cURL request or parsing the response.
     */

    public function loadModel(string $model, string $address): bool
    {
        $handle = curl_init();
        $address = rtrim($address, '/');
        $requestBody = ['model' => $model];

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
        if ($responseBody === null) {
            throw new \Exception('Failed to parse response from Ollama. CURL error: ' . curl_error($handle));
        }
        return $responseBody['done'] ?? false;
    }

    /**
     * Sends a chat request to the Ollama API and returns the response.
     *
     * @param string $model The model to use for the chat.
     * @param string $address The address of the Ollama API.
     * @param array $messages The messages to send in the chat.
     * @param string|null $format Optional. The format of the response.
     * @param array|null $options Optional. Additional options for the chat.
     * @param string|null $keep_alive Optional. Whether to keep the chat alive.
     *
     * @return object
     *
     * @throws \Exception If there is an error executing the cURL request or parsing the response.
     */

    public function chat(string $model, string $address, array $messages, ?string $format, ?array $options, ?string $keep_alive): Response
    {
        $handle = curl_init();
        $address = rtrim($address, '/');
        $requestBody = array_merge([
            'model' => $model,
            'messages' => $messages,
            'stream' => false,
        ], $options ?? []);
        if ($format !== null) {
            $requestBody['format'] = $format;
        }
        if ($keep_alive !== null) {
            $requestBody['keep_alive'] = $keep_alive;
        }

        curl_setopt_array($handle, [
            CURLOPT_URL            => "{$address}/api/chat",
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
        if ($responseBody === null) {
            throw new \Exception('Failed to parse response from Ollama. CURL error: ' . curl_error($handle));
        }
        return new Response(
            $responseBody['created_at'],
            $responseBody['total_duration'] ?? 0,
            $responseBody['load_duration'] ?? 0,
            $responseBody['prompt_eval_count'] ?? 0,
            $responseBody['prompt_eval_duration'] ?? 0,
            $responseBody['eval_count'] ?? 0,
            $responseBody['eval_duration'] ?? 0,
            $responseBody['context'] ?? array(),
            json_encode($responseBody['message']) ?? '',
        );
    }

    public function createModel(string $name, ?string $modelfile, ?string $path)
    {
        $handle = curl_init();
        $address = rtrim($path, '/');
        $requestBody = array_merge([
            'name' => $name,
            'modelfile' => $modelfile,
            'stream' => false,
        ]);

        if ($path !== null) {
            $requestBody['path'] = $path;
        }

        curl_setopt_array($handle, [
            CURLOPT_URL            => "{$address}/api/create",
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
        if ($responseBody === null) {
            throw new \Exception('Failed to parse response from Ollama. CURL error: ' . curl_error($handle));
        }
        return $responseBody['status'] = 'success' ?? false;
    }

    /**
     * Lists all the models available in the Ollama API.
     *
     * @param string $address The address of the Ollama API.
     *
     * @return object Returns an object containing the list of models.
     *
     * @throws \Exception If there is an error executing the cURL request or parsing the response.
     */

    public function listModels(string $address): object
    {
        $handle = curl_init();
        $address = rtrim($address, '/');

        curl_setopt_array($handle, [
            CURLOPT_URL            => "{$address}/api/tags",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_MAXREDIRS      => 10,
            CURLOPT_TIMEOUT        => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST  => "POST",
            CURLOPT_HTTPHEADER     => [
                'Content-Type: application/json',
            ],
        ]);
        $response = curl_exec($handle);
        curl_close($handle);
        $responseBody = json_decode($response, true);
        if ($responseBody === null) {
            throw new \Exception('Failed to parse response from Ollama. CURL error: ' . curl_error($handle));
        }
        return $responseBody;
    }
}
