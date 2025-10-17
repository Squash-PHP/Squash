<?php


namespace Squash\Logging;

use Squash\Contract\LoggerInterface;


final class Logger implements LoggerInterface
{
    private string $logFile;
    private array $handlers = [];

    public function __construct(string $logFile = null)
    {
        $this->logFile = $logFile ?? sys_get_temp_dir() . '/squash.log';
    }

    public function addHandler(callable $handler): void
    {
        $this->handlers[] = $handler;
    }

    public function log(string $level, string $message, array $context = []): void
    {
        $timestamp = date('Y-m-d H:i:s');
        $contextStr = !empty($context) ? json_encode($context) : '';
        $logMessage = sprintf(
            "[%s] %s: %s %s" . PHP_EOL,
            $timestamp,
            strtoupper($level),
            $message,
            $contextStr
        );

        // Write to file
        file_put_contents($this->logFile, $logMessage, FILE_APPEND);

        // Call custom handlers
        foreach ($this->handlers as $handler) {
            $handler($level, $message, $context);
        }
    }

    public function emergency(string $message, array $context = []): void
    {
        $this->log('emergency', $message, $context);
    }

    public function alert(string $message, array $context = []): void
    {
        $this->log('alert', $message, $context);
    }

    public function critical(string $message, array $context = []): void
    {
        $this->log('critical', $message, $context);
    }

    public function error(string $message, array $context = []): void
    {
        $this->log('error', $message, $context);
    }

    public function warning(string $message, array $context = []): void
    {
        $this->log('warning', $message, $context);
    }

    public function notice(string $message, array $context = []): void
    {
        $this->log('notice', $message, $context);
    }

    public function info(string $message, array $context = []): void
    {
        $this->log('info', $message, $context);
    }

    public function debug(string $message, array $context = []): void
    {
        $this->log('debug', $message, $context);
    }
}
