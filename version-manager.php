<?php


// Expected usage.


use Squash\Contract\Api\Generate\Request;

require __DIR__ . '/vendor/autoload.php';

$squash = \Squash\Squash::create();

$request = new Request(
        'http://0.0.0.0:11434/',
        'this sentence is false',
        'qwen:0.5b',
        null,
        null,
        null,
        null,
        null,
        false,
        '30s'
);
$generationResult = $squash->ollama()->generate($request);

echo $generationResult->response . PHP_EOL;
