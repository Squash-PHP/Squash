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
}