<?php


namespace Squash\Logging;


use PHPUnit\Framework\TestCase;


class LoggerTest extends TestCase
{
    private string $logFile;
    private Logger $logger;

    protected function setUp(): void
    {
        $this->logFile = sys_get_temp_dir() . '/test_' . uniqid() . '.log';
        $this->logger = new Logger($this->logFile);
    }

    protected function tearDown(): void
    {
        if (file_exists($this->logFile)) {
            unlink($this->logFile);
        }
    }

    public function testLogWritesToFile(): void
    {
        $this->logger->log('info', 'Test message');
        
        $this->assertFileExists($this->logFile);
        $content = file_get_contents($this->logFile);
        $this->assertStringContainsString('INFO: Test message', $content);
    }

    public function testLogWithContext(): void
    {
        $context = ['user' => 'john', 'action' => 'login'];
        $this->logger->log('info', 'User action', $context);
        
        $content = file_get_contents($this->logFile);
        $this->assertStringContainsString('User action', $content);
        $this->assertStringContainsString('john', $content);
        $this->assertStringContainsString('login', $content);
    }

    public function testEmergency(): void
    {
        $this->logger->emergency('Emergency message');
        
        $content = file_get_contents($this->logFile);
        $this->assertStringContainsString('EMERGENCY: Emergency message', $content);
    }

    public function testAlert(): void
    {
        $this->logger->alert('Alert message');
        
        $content = file_get_contents($this->logFile);
        $this->assertStringContainsString('ALERT: Alert message', $content);
    }

    public function testCritical(): void
    {
        $this->logger->critical('Critical message');
        
        $content = file_get_contents($this->logFile);
        $this->assertStringContainsString('CRITICAL: Critical message', $content);
    }

    public function testError(): void
    {
        $this->logger->error('Error message');
        
        $content = file_get_contents($this->logFile);
        $this->assertStringContainsString('ERROR: Error message', $content);
    }

    public function testWarning(): void
    {
        $this->logger->warning('Warning message');
        
        $content = file_get_contents($this->logFile);
        $this->assertStringContainsString('WARNING: Warning message', $content);
    }

    public function testNotice(): void
    {
        $this->logger->notice('Notice message');
        
        $content = file_get_contents($this->logFile);
        $this->assertStringContainsString('NOTICE: Notice message', $content);
    }

    public function testInfo(): void
    {
        $this->logger->info('Info message');
        
        $content = file_get_contents($this->logFile);
        $this->assertStringContainsString('INFO: Info message', $content);
    }

    public function testDebug(): void
    {
        $this->logger->debug('Debug message');
        
        $content = file_get_contents($this->logFile);
        $this->assertStringContainsString('DEBUG: Debug message', $content);
    }

    public function testCustomHandler(): void
    {
        $handlerCalled = false;
        $handlerLevel = null;
        $handlerMessage = null;
        
        $this->logger->addHandler(function ($level, $message, $context) use (&$handlerCalled, &$handlerLevel, &$handlerMessage) {
            $handlerCalled = true;
            $handlerLevel = $level;
            $handlerMessage = $message;
        });
        
        $this->logger->info('Test message');
        
        $this->assertTrue($handlerCalled);
        $this->assertEquals('info', $handlerLevel);
        $this->assertEquals('Test message', $handlerMessage);
    }
}
