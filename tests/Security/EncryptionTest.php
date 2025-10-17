<?php


namespace Squash\Security;


use PHPUnit\Framework\TestCase;


class EncryptionTest extends TestCase
{
    private Encryption $encryption;

    protected function setUp(): void
    {
        $this->encryption = new Encryption();
    }

    public function testEncryptAndDecrypt(): void
    {
        $data = 'secret message';
        $key = 'my_secret_key';
        
        $encrypted = $this->encryption->encrypt($data, $key);
        $this->assertNotEquals($data, $encrypted);
        
        $decrypted = $this->encryption->decrypt($encrypted, $key);
        $this->assertEquals($data, $decrypted);
    }

    public function testEncryptProducesDifferentOutputEachTime(): void
    {
        $data = 'secret message';
        $key = 'my_secret_key';
        
        $encrypted1 = $this->encryption->encrypt($data, $key);
        $encrypted2 = $this->encryption->encrypt($data, $key);
        
        // Even with the same input, output should differ due to different IV
        $this->assertNotEquals($encrypted1, $encrypted2);
        
        // But both should decrypt to the same value
        $this->assertEquals($data, $this->encryption->decrypt($encrypted1, $key));
        $this->assertEquals($data, $this->encryption->decrypt($encrypted2, $key));
    }

    public function testDecryptWithWrongKey(): void
    {
        $data = 'secret message';
        $correctKey = 'correct_key';
        $wrongKey = 'wrong_key';
        
        $encrypted = $this->encryption->encrypt($data, $correctKey);
        $decrypted = $this->encryption->decrypt($encrypted, $wrongKey);
        
        $this->assertNotEquals($data, $decrypted);
    }

    public function testEncryptEmptyString(): void
    {
        $data = '';
        $key = 'my_secret_key';
        
        $encrypted = $this->encryption->encrypt($data, $key);
        $decrypted = $this->encryption->decrypt($encrypted, $key);
        
        $this->assertEquals($data, $decrypted);
    }
}
