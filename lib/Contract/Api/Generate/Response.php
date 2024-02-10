<?php

namespace Squash\Contract\Api\Generate;


final class Response {
    public string $createdAt;
    public int $totalDuration;
    public int $loadDuration;
    public int $promptEvalCount;
    public int $promptEvalDuration;
    public int $evalCount;
    public int $evalDuration;
    public array $context;
    public string $response;

    public function __construct(
            string $createdAt,
            int    $totalDuration,
            int    $loadDuration,
            int    $promptEvalCount,
            int    $promptEvalDuration,
            int    $evalCount,
            int    $evalDuration,
            array $context,
            string $response
    ) {
        $this->totalDuration = $totalDuration;
        $this->loadDuration = $loadDuration;
        $this->promptEvalCount = $promptEvalCount;
        $this->promptEvalDuration = $promptEvalDuration;
        $this->evalCount = $evalCount;
        $this->evalDuration = $evalDuration;
        $this->context = $context;
        $this->response = $response;
    }


}
