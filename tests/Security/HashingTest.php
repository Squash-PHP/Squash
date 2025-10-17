<?php


namespace Squash\Security;


use PHPUnit\Framework\TestCase;


class HashingTest extends TestCase
{
    private Hashing $hashing;

    protected function setUp(): void
    {
        $this->hashing = new Hashing();
    }

    public function testHash(): void
    {
        $data = 'password123';
        $hash = $this->hashing->hash($data);
        
        $this->assertNotEquals($data, $hash);
        $this->assertNotEmpty($hash);
    }

    public function testHashProducesDifferentOutputEachTime(): void
    {
        $data = 'password123';
        
        $hash1 = $this->hashing->hash($data);
        $hash2 = $this->hashing->hash($data);
        
        // Different hashes due to different salts
        $this->assertNotEquals($hash1, $hash2);
    }

    public function testVerify(): void
    {
        $data = 'password123';
        $hash = $this->hashing->hash($data);
        
        $this->assertTrue($this->hashing->verify($data, $hash));
    }

    public function testVerifyWithWrongPassword(): void
    {
        $data = 'password123';
        $wrongData = 'wrongpassword';
        $hash = $this->hashing->hash($data);
        
        $this->assertFalse($this->hashing->verify($wrongData, $hash));
    }

    public function testVerifyWithEmptyPassword(): void
    {
        $data = '';
        $hash = $this->hashing->hash($data);
        
        $this->assertTrue($this->hashing->verify($data, $hash));
    }
}
