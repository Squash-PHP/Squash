<?php


namespace Squash\Contract;

interface FileSystemInterface
{
    public function isFileInDirectory(string $directory, string $file): bool;

    public function listFilesInDirectory(string $directory, bool $addNewline = true): string;

    public function replaceFile(string $directory, string $destination, string $source): void;
}