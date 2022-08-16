<?php


namespace Squash;

use Squash\Contract\FileSystemInterface;
use Squash\Contract\RandomGeneratorInterface;
use Squash\Contract\TimerInterface;
use Squash\Contract\UuidInterface;


final class Legacy implements RandomGeneratorInterface, UuidInterface, FileSystemInterface, TimerInterface
{
    private \Squash $squash;

    public function __construct(\Squash $squash)
    {
        $this->squash = $squash;
    }

    public function isFileInDirectory(string $directory, string $file): bool
    {
        return $this->squash->file_in_dir($file, $directory);
    }

    public function listFilesInDirectory(string $directory, bool $addNewline = true): string
    {
        return $this->squash->files_in_dir($directory, $addNewline);
    }

    /**
     * Take notice: this calls `die()` if it can't write to `$destination` or `$source`.
     *
     * @param string $directory
     * @param string $destination
     * @param string $source
     */
    public function replaceFile(string $directory, string $destination, string $source): void
    {
        $this->squash->update_file($directory, $destination, $source);
    }

    public function generateString(int $length): string
    {
        return $this->squash->generateRandomString($length);
    }

    public function generateUuid(): string
    {
        return $this->squash->uuid();
    }

    public function wait(int $period): void
    {
        $this->squash->sleepms($period);
    }
}