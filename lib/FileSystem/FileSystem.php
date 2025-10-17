<?php


namespace Squash\FileSystem;

use Squash\Contract\FileSystemInterface;


final class FileSystem implements FileSystemInterface
{
    public function isFileInDirectory(string $directory, string $file): bool
    {
        return is_file($this->append($directory, $file));
    }

    public function listFilesInDirectory(string $directory, bool $addNewline = true): string
    {
        $files = scandir($directory);

        $files = array_map(
            fn (string $filename): string => $this->append($directory, $filename),
            array_filter($files, fn (string $filename): bool => !$this->isDot($filename))
        );

        return implode($addNewline ? PHP_EOL : '', $files);
    }

    /**
     * TODO: Replace strcmp with md5_file check.
     *
     * @param string $directory
     * @param string $destination
     * @param string $source
     */
    public function replaceFile(string $directory, string $destination, string $source): void
    {
        $destinationPath = $this->append($directory, $destination);
        $sourcePath = $this->append($directory, $source);

        if (!is_file($destinationPath)) {
            touch($destinationPath);
        }

        $sourceContents = file_get_contents($sourcePath);

        if (md5_file($destinationPath) === md5_file($sourcePath)) {
            return;
        }

        file_put_contents($destinationPath, $sourceContents);
    }

    private function isDot(string $filename): bool
    {
        return $filename == '.' || $filename == '..';
    }

    private function append(string $directory, string $part): string
    {
        return rtrim($directory, '/\\') . DIRECTORY_SEPARATOR . ltrim($part, '/\\');
    }

    public function read(string $path): string
    {
        if (!file_exists($path)) {
            throw new \RuntimeException("File not found: $path");
        }

        if (!is_readable($path)) {
            throw new \RuntimeException("File not readable: $path");
        }

        $contents = file_get_contents($path);
        
        if ($contents === false) {
            throw new \RuntimeException("Failed to read file: $path");
        }

        return $contents;
    }

    public function write(string $path, string $content): bool
    {
        $dir = dirname($path);
        
        if (!is_dir($dir)) {
            if (!mkdir($dir, 0755, true)) {
                throw new \RuntimeException("Failed to create directory: $dir");
            }
        }

        if (file_put_contents($path, $content) === false) {
            throw new \RuntimeException("Failed to write file: $path");
        }

        return true;
    }

    public function delete(string $path): bool
    {
        if (!file_exists($path)) {
            return true;
        }

        if (!is_file($path)) {
            throw new \RuntimeException("Path is not a file: $path");
        }

        if (!unlink($path)) {
            throw new \RuntimeException("Failed to delete file: $path");
        }

        return true;
    }

    public function deleteDirectory(string $path): bool
    {
        if (!file_exists($path)) {
            return true;
        }

        if (!is_dir($path)) {
            throw new \RuntimeException("Path is not a directory: $path");
        }

        $files = array_diff(scandir($path), ['.', '..']);
        
        foreach ($files as $file) {
            $filePath = $path . DIRECTORY_SEPARATOR . $file;
            
            if (is_dir($filePath)) {
                $this->deleteDirectory($filePath);
            } else {
                $this->delete($filePath);
            }
        }

        if (!rmdir($path)) {
            throw new \RuntimeException("Failed to delete directory: $path");
        }

        return true;
    }
}