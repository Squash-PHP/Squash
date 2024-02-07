<?php

namespace Squash\Contract\Api\Generate;

final class Request {
    const DEFAULT_STAY_ALIVE = '30s';
    public string  $address;
    public string  $prompt;
    public string  $model;
    public ?string $images;
    public ?string $format;
    public ?string $system;
    public ?string $template;
    public ?string $context;
    public bool    $raw;
    public string  $stayAlive;

    public function __construct(
            string  $address,
            string  $prompt,
            string  $model,
            ?string $images = null,
            ?string $format = null,
            ?string $system = null,
            ?string $template = null,
            ?string $context = null,
            bool    $raw = false,
            string  $stayAlive = Request::DEFAULT_STAY_ALIVE
    ) {
        $this->address = $address;
        $this->prompt = $prompt;
        $this->model = $model;
        $this->images = $images;
        $this->format = $format;
        $this->system = $system;
        $this->template = $template;
        $this->context = $context;
        $this->raw = $raw;
        $this->stayAlive = $stayAlive;
    }

    public function toArray(): array {
        return array_filter([
                'model'     => $this->model,
                'prompt'    => $this->prompt,
                'images'    => $this->images,
                'format'    => $this->format,
                'system'    => $this->system,
                'template'  => $this->template,
                'context'   => $this->context,
                'raw'       => $this->raw,
                'stayalive' => $this->stayAlive,
        ]);
    }
}
