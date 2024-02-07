<?php

namespace Squash\APIs\Ollama;

use Squash\Contract\APIInterface;

final class OllamaAPIController
{
    /**
     * Will use the Ollama API to generate a response.
     *
     * @param string $address The URL to which the request is sent.
     * @param string $prompt The prompt for the model.
     * @param string $model The model to be used.
     * @param string|null $images Optional. The images to be used (base64 encoded).
     * @param string|null $format Optional. The format of the response.
     * @param string|null $system Optional. The system prompt to be used.
     * @param string|null $template Optional. The template to be used.
     * @param string|null $context Optional. The context to be used.
     * @param bool $raw Optional. If true, the response will be non-formatted.
     * @param string $stayalive Optional. The duration for which the model should stay alive (default 30s).
     *
     * @return object The response from the request.
     */
    public function generate(string $address, string $prompt, string $model, string $images = null, string $format = null, string $system = null, string $template = null, string $context = null, bool $raw = false, string $stayalive = '30s'): object
    {
        $data = array(
            'model' => $model,
            'prompt' => $prompt
        );
        if ($images) {
            $data['images'] = $images;
        }
        if ($format) {
            $data['format'] = $format;
        }
        if ($system) {
            $data['system'] = $system;
        }
        if ($template) {
            $data['template'] = $template;
        }
        if ($context) {
            $data['context'] = $context;
        }
        if ($raw) {
            $data['raw'] = $raw;
        }
        if ($stayalive) {
            $data['stayalive'] = $stayalive;
        }
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $address . "/api/generate",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json"
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $res = json_decode($response);
        return $res;
    }
}
