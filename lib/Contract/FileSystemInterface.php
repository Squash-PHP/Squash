<?php


namespace Squash\Contract;

interface FileSystemInterface
{
    public function isFileInDirectory(string $directory, string $file): bool;

    public function listFilesInDirectory(string $directory, bool $addNewline = true): string;

    public function replaceFile(string $directory, string $destination, string $source): void;

    public function read(string $path): string;

    public function write(string $path, string $content): bool;

    public function delete(string $path): bool;

    public function deleteDirectory(string $path): bool;
}