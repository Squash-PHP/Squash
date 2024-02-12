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

    /**
     * Creates a new model in the Ollama API.
     *
     * @param string $name The name of the new model.
     * @param string|null $modelfile Optional. The file of the model.
     * @param string|null $path Optional. The path where the model will be created.
     *
     * @return bool Returns true if the model was successfully created, false otherwise.
     *
     * @throws \Exception If there is an error executing the cURL request or parsing the response.
     */

    public function createModel(string $address, string $name, ?string $modelfile, ?string $path): bool
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

    /**
     * Retrieves information about a specific model from the Ollama API.
     *
     * @param string $address The address of the Ollama API.
     * @param string $model The name of the model to retrieve information about.
     *
     * @return object Returns an object containing the model information.
     *
     * @throws \Exception If there is an error executing the cURL request or parsing the response.
     */

    public function showModelInfo(string $address, string $model): object
    {
        $handle = curl_init();
        $address = rtrim($address, '/');
        $requestBody = array_merge([
            'name' => $model
        ]);
        curl_setopt_array($handle, [
            CURLOPT_URL            => "{$address}/api/show",
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
        return $responseBody;
    }

    /**
     * Copies a model in the Ollama API.
     *
     * @param string $address The address of the Ollama API.
     * @param string $source The name of the model to copy.
     * @param string $destination The name of the new model.
     *
     * @return bool Returns true if the model was successfully copied (HTTP status code 200), false otherwise.
     *
     * @throws \Exception If there is an error executing the cURL request.
     */

    public function copyModel(string $address, string $source, string $destination): bool
    {
        $handle = curl_init();
        $address = rtrim($address, '/');
        $requestBody = array_merge([
            "source" => $source,
            "destination" => $destination
        ]);
        curl_setopt_array($handle, [
            CURLOPT_URL            => "{$address}/api/copy",
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
        $httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
        curl_close($handle);
        return $httpCode == 200;
    }

    /**
     * Deletes a model in the Ollama API.
     *
     * @param string $address The address of the Ollama API.
     * @param string $name The name of the model to delete.
     *
     * @return bool Returns true if the model was successfully deleted (HTTP status code 200), false otherwise.
     *
     * @throws \Exception If there is an error executing the cURL request.
     */

    public function deleteModel(string $address, string $name): bool
    {
        $handle = curl_init();
        $address = rtrim($address, '/');
        $requestBody = array_merge([
            "name" => $name
        ]);
        var_dump($requestBody);
        curl_setopt_array($handle, [
            CURLOPT_URL            => "{$address}/api/delete",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_MAXREDIRS      => 10,
            CURLOPT_TIMEOUT        => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST  => "DELETE",
            CURLOPT_POSTFIELDS     => json_encode($requestBody),
            CURLOPT_HTTPHEADER     => [
                'Content-Type: application/json',
            ],
        ]);
        $response = curl_exec($handle);
        $httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
        curl_close($handle);
        return $httpCode == 200;
    }

    /**
     * Pulls a model from the Ollama API.
     *
     * @param string $address The address of the Ollama API.
     * @param string $name The name of the model to pull.
     * @param string|null $insecure Optional. If set, the connection will be insecure.
     *
     * @return bool Returns true if the model was successfully pulled (status 'success'), false otherwise.
     *
     * @throws \Exception If there is an error executing the cURL request or parsing the response.
     */

    public function pullModel(string $address, string $name, ?string $insecure): bool
    {
        $handle = curl_init();
        $address = rtrim($address, '/');
        $requestBody = array_merge([
            'name' => $name,
            'stream' => false
        ]);

        if ($insecure !== null) {
            $requestBody['insecure'] = $insecure;
        }

        curl_setopt_array($handle, [
            CURLOPT_URL            => "{$address}/api/pull",
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
     * Pushes a model to the Ollama API.
     *
     * @param string $address The address of the Ollama API.
     * @param string $name The name of the model to push.
     * @param string|null $insecure Optional. If set, the connection will be insecure.
     *
     * @return bool Returns true if the model was successfully pushed (status 'success'), false otherwise.
     *
     * @throws \Exception If there is an error executing the cURL request or parsing the response.
     */

    public function pushModel(string $address, string $name, ?string $insecure): bool
    {
        $handle = curl_init();
        $address = rtrim($address, '/');
        $requestBody = array_merge([
            'name' => $name,
            'stream' => false
        ]);

        if ($insecure !== null) {
            $requestBody['insecure'] = $insecure;
        }

        curl_setopt_array($handle, [
            CURLOPT_URL            => "{$address}/api/push",
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
     * Generates embeddings using a specific model in the Ollama API.
     *
     * @param string $address The address of the Ollama API.
     * @param string $model The name of the model to use for generating embeddings.
     * @param string $prompt The prompt to use for generating embeddings.
     * @param array|null $options Optional. Additional options for generating embeddings.
     * @param string|null $keepAlive Optional. Whether to keep the connection alive.
     *
     * @return object Returns an object containing the embeddings.
     *
     * @throws \Exception If there is an error executing the cURL request or parsing the response.
     */

    public function generateEmbeddings(string $address, string $model, string $prompt, ?array $options, ?string $keepAlive): object
    {
        $handle = curl_init();
        $address = rtrim($address, '/');
        $requestBody = array_merge([
            'model' => $model,
            'prompt' => $prompt
        ]);

        if ($keepAlive !== null) {
            $requestBody['keep_alive'] = $keepAlive;
        }
        if ($options !== null) {
            $requestBody['options'] = $options;
        }

        curl_setopt_array($handle, [
            CURLOPT_URL            => "{$address}/api/embeddings",
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
        return $responseBody;
    }
}
