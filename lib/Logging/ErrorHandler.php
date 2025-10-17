<?php


namespace Squash\Logging;

use Squash\Contract\ErrorHandlerInterface;
use Squash\Contract\LoggerInterface;


final class ErrorHandler implements ErrorHandlerInterface
{
    private ?LoggerInterface $logger;

    public function __construct(LoggerInterface $logger = null)
    {
        $this->logger = $logger;
    }

    public function handleError(int $errno, string $errstr, string $errfile, int $errline): bool
    {
        if ($this->logger) {
            $this->logger->error($errstr, [
                'errno' => $errno,
                'file' => $errfile,
                'line' => $errline
            ]);
        }

        // Return false to let PHP's internal error handler continue
        return false;
    }

    public function handleException(\Throwable $exception): void
    {
        if ($this->logger) {
            $this->logger->critical($exception->getMessage(), [
                'exception' => get_class($exception),
                'file' => $exception->getFile(),
                'line' => $exception->getLine(),
                'trace' => $exception->getTraceAsString()
            ]);
        }
    }

    public function register(): void
    {
        set_error_handler([$this, 'handleError']);
        set_exception_handler([$this, 'handleException']);
    }
}
