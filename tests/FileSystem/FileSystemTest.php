<?php


namespace Squash\FileSystem;


use PHPUnit\Framework\TestCase;


class FileSystemTest extends TestCase
{
    public static function setUpBeforeClass(): void
    {
        mkdir(__DIR__ . '/files/');
    }

    public function setUp(): void
    {
        file_put_contents(__DIR__ . '/files/test.txt', '123');
    }

    public function tearDown(): void
    {
        unlink(__DIR__ . '/files/test.txt');
        if (is_file(__DIR__ . '/files/new-file.txt')) {
            unlink(__DIR__ . '/files/new-file.txt');
        }
    }

    public static function tearDownAfterClass(): void
    {
        if (is_file(__DIR__ . '/files/test.txt')) {
            unlink(__DIR__ . '/files/test.txt');
        }

        rmdir(__DIR__ . '/files/');
    }

    public function testIsFileInDirectory(): void
    {
        $fs = new FileSystem();
        $this->assertTrue($fs->isFileInDirectory(__DIR__ . '/files/', 'test.txt'));
    }

    public function testIsFileInDirectoryNoFile(): void
    {
        $fs = new FileSystem();
        $this->assertFalse($fs->isFileInDirectory(__DIR__ . '/files/', 'no-file'));
    }

    public function testIsFileInDirectoryNotAFile(): void
    {
        $fs = new FileSystem();
        $this->assertFalse($fs->isFileInDirectory(__DIR__, '/files/'));
    }

    public function testListFilesInDirectory(): void
    {
        $fs = new FileSystem();
        $list = $fs->listFilesInDirectory(__DIR__ . '/files');

        $files = explode(PHP_EOL, $list);
        foreach ($files as $file) {
            $this->assertFileExists($file);
        }
    }

    public function testReplaceFile(): void
    {
        $fs = new FileSystem();
        $fs->replaceFile(__DIR__ . '/files', 'new-file.txt', 'test.txt');
        $this->assertFileEquals(__DIR__ . '/files/test.txt', __DIR__ . '/files/new-file.txt');
    }

    public function testReplaceFileDestinationExists(): void
    {
        file_put_contents(__DIR__ . '/files/new-file.txt', '321');

        $fs = new FileSystem();
        $fs->replaceFile(__DIR__ . '/files', 'new-file.txt', 'test.txt');
        $this->assertFileEquals(__DIR__ . '/files/test.txt', __DIR__ . '/files/new-file.txt');
    }

    public function testReplaceFileDestinationHasSameContent(): void
    {
        file_put_contents(__DIR__ . '/files/new-file.txt', '123');

        $fs = new FileSystem();
        $fs->replaceFile(__DIR__ . '/files', 'new-file.txt', 'test.txt');
        $this->assertFileEquals(__DIR__ . '/files/test.txt', __DIR__ . '/files/new-file.txt');
    }
}
