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

    public function testRead(): void
    {
        $fs = new FileSystem();
        $content = $fs->read(__DIR__ . '/files/test.txt');
        $this->assertEquals('123', $content);
    }

    public function testReadNonexistentFile(): void
    {
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('File not found');
        
        $fs = new FileSystem();
        $fs->read(__DIR__ . '/files/nonexistent.txt');
    }

    public function testWrite(): void
    {
        $fs = new FileSystem();
        $path = __DIR__ . '/files/write-test.txt';
        
        $this->assertTrue($fs->write($path, 'test content'));
        $this->assertFileExists($path);
        $this->assertEquals('test content', file_get_contents($path));
        
        unlink($path);
    }

    public function testWriteCreatesDirectory(): void
    {
        $fs = new FileSystem();
        $path = __DIR__ . '/files/subdir/write-test.txt';
        
        $this->assertTrue($fs->write($path, 'test content'));
        $this->assertFileExists($path);
        
        unlink($path);
        rmdir(__DIR__ . '/files/subdir');
    }

    public function testDelete(): void
    {
        $path = __DIR__ . '/files/delete-test.txt';
        file_put_contents($path, 'test');
        
        $fs = new FileSystem();
        $this->assertTrue($fs->delete($path));
        $this->assertFileDoesNotExist($path);
    }

    public function testDeleteNonexistentFile(): void
    {
        $fs = new FileSystem();
        $this->assertTrue($fs->delete(__DIR__ . '/files/nonexistent.txt'));
    }

    public function testDeleteDirectory(): void
    {
        $dir = __DIR__ . '/files/test-dir';
        mkdir($dir);
        file_put_contents($dir . '/file1.txt', 'test1');
        file_put_contents($dir . '/file2.txt', 'test2');
        mkdir($dir . '/subdir');
        file_put_contents($dir . '/subdir/file3.txt', 'test3');
        
        $fs = new FileSystem();
        $this->assertTrue($fs->deleteDirectory($dir));
        $this->assertDirectoryDoesNotExist($dir);
    }

    public function testDeleteDirectoryNonexistent(): void
    {
        $fs = new FileSystem();
        $this->assertTrue($fs->deleteDirectory(__DIR__ . '/files/nonexistent-dir'));
    }
}
