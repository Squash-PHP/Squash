<?php


namespace Squash\Cache;

use Squash\Contract\CacheInterface;


final class Cache implements CacheInterface
{
    private string $cacheDir;
    private array $cache = [];

    public function __construct(string $cacheDir = null)
    {
        $this->cacheDir = $cacheDir ?? sys_get_temp_dir() . '/squash_cache';
        
        if (!is_dir($this->cacheDir)) {
            mkdir($this->cacheDir, 0755, true);
        }
    }

    public function get(string $key, $default = null)
    {
        // Check memory cache first
        if (isset($this->cache[$key])) {
            $item = $this->cache[$key];
            if ($this->isExpired($item)) {
                unset($this->cache[$key]);
                $this->delete($key);
                return $default;
            }
            return $item['value'];
        }

        // Check file cache
        $filePath = $this->getFilePath($key);
        if (!file_exists($filePath)) {
            return $default;
        }

        $contents = file_get_contents($filePath);
        
        // Validate that it's safe to unserialize
        if ($contents === false || empty($contents)) {
            return $default;
        }
        
        $data = @unserialize($contents);
        
        // Validate unserialized data structure
        if (!is_array($data) || !isset($data['value']) || !isset($data['expires'])) {
            $this->delete($key);
            return $default;
        }
        
        if ($this->isExpired($data)) {
            $this->delete($key);
            return $default;
        }

        // Store in memory cache
        $this->cache[$key] = $data;
        
        return $data['value'];
    }

    public function set(string $key, $value, int $ttl = 0): bool
    {
        $item = [
            'value' => $value,
            'expires' => $ttl > 0 ? time() + $ttl : 0
        ];

        // Store in memory cache
        $this->cache[$key] = $item;

        // Store in file cache
        $filePath = $this->getFilePath($key);
        return file_put_contents($filePath, serialize($item)) !== false;
    }

    public function has(string $key): bool
    {
        // Check memory cache first
        if (isset($this->cache[$key])) {
            $item = $this->cache[$key];
            return !$this->isExpired($item);
        }

        // Check file cache
        $filePath = $this->getFilePath($key);
        if (!file_exists($filePath)) {
            return false;
        }

        $contents = file_get_contents($filePath);
        if ($contents === false || empty($contents)) {
            return false;
        }
        
        $data = @unserialize($contents);
        if (!is_array($data) || !isset($data['value']) || !isset($data['expires'])) {
            return false;
        }
        
        return !$this->isExpired($data);
    }

    public function delete(string $key): bool
    {
        unset($this->cache[$key]);
        
        $filePath = $this->getFilePath($key);
        if (file_exists($filePath)) {
            return unlink($filePath);
        }
        
        return true;
    }

    public function clear(): bool
    {
        $this->cache = [];
        
        $files = glob($this->cacheDir . '/*');
        foreach ($files as $file) {
            if (is_file($file)) {
                unlink($file);
            }
        }
        
        return true;
    }

    private function getFilePath(string $key): string
    {
        return $this->cacheDir . '/' . md5($key) . '.cache';
    }

    private function isExpired(array $item): bool
    {
        return $item['expires'] > 0 && $item['expires'] < time();
    }
}
