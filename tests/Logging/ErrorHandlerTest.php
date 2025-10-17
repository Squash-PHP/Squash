<?php


namespace Squash\Logging;


use PHPUnit\Framework\TestCase;


class ErrorHandlerTest extends TestCase
{
    private string $logFile;
    private Logger $logger;
    private ErrorHandler $errorHandler;

    protected function setUp(): void
    {
        $this->logFile = sys_get_temp_dir() . '/error_test_' . uniqid() . '.log';
        $this->logger = new Logger($this->logFile);
        $this->errorHandler = new ErrorHandler($this->logger);
    }

    protected function tearDown(): void
    {
        restore_error_handler();
        restore_exception_handler();
        
        if (file_exists($this->logFile)) {
            unlink($this->logFile);
        }
    }

    public function testHandleError(): void
    {
        $result = $this->errorHandler->handleError(
            E_USER_WARNING,
            'Test warning',
            '/path/to/file.php',
            42
        );
        
        $this->assertFalse($result);
        
        $content = file_get_contents($this->logFile);
        $this->assertStringContainsString('Test warning', $content);
        $this->assertStringContainsString('file.php', $content);
        $this->assertStringContainsString('"line":42', $content);
    }

    public function testHandleException(): void
    {
        $exception = new \Exception('Test exception', 123);
        
        $this->errorHandler->handleException($exception);
        
        $content = file_get_contents($this->logFile);
        $this->assertStringContainsString('Test exception', $content);
        $this->assertStringContainsString('Exception', $content);
    }

    public function testRegister(): void
    {
        $this->errorHandler->register();
        
        // Trigger an error
        @trigger_error('Registered error', E_USER_NOTICE);
        
        $content = file_get_contents($this->logFile);
        $this->assertStringContainsString('Registered error', $content);
    }

    public function testErrorHandlerWithoutLogger(): void
    {
        $handler = new ErrorHandler();
        
        $result = $handler->handleError(
            E_USER_WARNING,
            'Test warning',
            '/path/to/file.php',
            42
        );
        
        $this->assertFalse($result);
    }

    public function testExceptionHandlerWithoutLogger(): void
    {
        $handler = new ErrorHandler();
        $exception = new \Exception('Test exception');
        
        // Should not throw
        $handler->handleException($exception);
        $this->assertTrue(true);
    }
}
