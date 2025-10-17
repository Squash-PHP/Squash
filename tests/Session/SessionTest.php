<?php


namespace Squash\Session;


use PHPUnit\Framework\TestCase;


class SessionTest extends TestCase
{
    private Session $session;

    protected function setUp(): void
    {
        $this->session = new Session();
    }

    /**
     * @runInSeparateProcess
     */
    public function testStart(): void
    {
        $this->assertTrue($this->session->start());
        $this->assertEquals(PHP_SESSION_ACTIVE, session_status());
    }

    /**
     * @runInSeparateProcess
     */
    public function testStartWhenAlreadyStarted(): void
    {
        $this->session->start();
        $this->assertTrue($this->session->start());
    }

    /**
     * @runInSeparateProcess
     */
    public function testSetAndGet(): void
    {
        $this->session->set('test_key', 'test_value');
        $this->assertEquals('test_value', $this->session->get('test_key'));
    }

    /**
     * @runInSeparateProcess
     */
    public function testGetWithDefault(): void
    {
        $this->assertEquals('default', $this->session->get('nonexistent', 'default'));
    }

    /**
     * @runInSeparateProcess
     */
    public function testHas(): void
    {
        $this->session->set('test_key', 'test_value');
        $this->assertTrue($this->session->has('test_key'));
        $this->assertFalse($this->session->has('nonexistent'));
    }

    /**
     * @runInSeparateProcess
     */
    public function testRemove(): void
    {
        $this->session->set('test_key', 'test_value');
        $this->assertTrue($this->session->has('test_key'));
        
        $this->session->remove('test_key');
        $this->assertFalse($this->session->has('test_key'));
    }

    /**
     * @runInSeparateProcess
     */
    public function testAll(): void
    {
        $this->session->set('key1', 'value1');
        $this->session->set('key2', 'value2');
        
        $all = $this->session->all();
        $this->assertIsArray($all);
        $this->assertArrayHasKey('key1', $all);
        $this->assertArrayHasKey('key2', $all);
    }

    /**
     * @runInSeparateProcess
     */
    public function testClear(): void
    {
        $this->session->set('key1', 'value1');
        $this->session->set('key2', 'value2');
        
        $this->session->clear();
        $this->assertEmpty($this->session->all());
    }

    /**
     * @runInSeparateProcess
     */
    public function testDestroy(): void
    {
        $this->session->start();
        $this->session->set('test_key', 'test_value');
        
        $this->assertTrue($this->session->destroy());
        $this->assertEquals(PHP_SESSION_NONE, session_status());
    }

    /**
     * @runInSeparateProcess
     */
    public function testDestroyWhenNotStarted(): void
    {
        $this->assertFalse($this->session->destroy());
    }
}
