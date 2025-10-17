<?php


namespace Squash\Cache;


use PHPUnit\Framework\TestCase;


class CacheTest extends TestCase
{
    private string $cacheDir;
    private Cache $cache;

    protected function setUp(): void
    {
        $this->cacheDir = sys_get_temp_dir() . '/cache_test_' . uniqid();
        $this->cache = new Cache($this->cacheDir);
    }

    protected function tearDown(): void
    {
        $this->cache->clear();
        if (is_dir($this->cacheDir)) {
            rmdir($this->cacheDir);
        }
    }

    public function testSetAndGet(): void
    {
        $this->assertTrue($this->cache->set('key', 'value'));
        $this->assertEquals('value', $this->cache->get('key'));
    }

    public function testGetWithDefault(): void
    {
        $this->assertEquals('default', $this->cache->get('nonexistent', 'default'));
    }

    public function testHas(): void
    {
        $this->cache->set('key', 'value');
        $this->assertTrue($this->cache->has('key'));
        $this->assertFalse($this->cache->has('nonexistent'));
    }

    public function testDelete(): void
    {
        $this->cache->set('key', 'value');
        $this->assertTrue($this->cache->has('key'));
        
        $this->assertTrue($this->cache->delete('key'));
        $this->assertFalse($this->cache->has('key'));
    }

    public function testDeleteNonexistent(): void
    {
        $this->assertTrue($this->cache->delete('nonexistent'));
    }

    public function testClear(): void
    {
        $this->cache->set('key1', 'value1');
        $this->cache->set('key2', 'value2');
        
        $this->assertTrue($this->cache->clear());
        $this->assertFalse($this->cache->has('key1'));
        $this->assertFalse($this->cache->has('key2'));
    }

    public function testSetWithTtl(): void
    {
        $this->cache->set('key', 'value', 1);
        $this->assertEquals('value', $this->cache->get('key'));
        
        sleep(2);
        $this->assertNull($this->cache->get('key'));
    }

    public function testPersistence(): void
    {
        $this->cache->set('key', 'value');
        
        // Create new cache instance with same directory
        $newCache = new Cache($this->cacheDir);
        $this->assertEquals('value', $newCache->get('key'));
    }

    public function testSetComplexValue(): void
    {
        $value = ['array' => [1, 2, 3], 'string' => 'test'];
        $this->cache->set('key', $value);
        $this->assertEquals($value, $this->cache->get('key'));
    }

    public function testSetNullValue(): void
    {
        $this->cache->set('key', null);
        $this->assertTrue($this->cache->has('key'));
        $this->assertNull($this->cache->get('key'));
    }
}
