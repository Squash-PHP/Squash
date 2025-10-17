<?php


namespace Squash\Security;

use Squash\Contract\EncryptionInterface;


final class Encryption implements EncryptionInterface
{
    private const CIPHER = 'AES-256-CBC';

    public function encrypt(string $data, string $key): string
    {
        $ivLength = openssl_cipher_iv_length(self::CIPHER);
        $iv = random_bytes($ivLength);
        
        $encrypted = openssl_encrypt(
            $data,
            self::CIPHER,
            hash('sha256', $key, true),
            OPENSSL_RAW_DATA,
            $iv
        );
        
        return base64_encode($iv . $encrypted);
    }

    public function decrypt(string $data, string $key): string
    {
        $data = base64_decode($data);
        $ivLength = openssl_cipher_iv_length(self::CIPHER);
        $iv = substr($data, 0, $ivLength);
        $encrypted = substr($data, $ivLength);
        
        $decrypted = openssl_decrypt(
            $encrypted,
            self::CIPHER,
            hash('sha256', $key, true),
            OPENSSL_RAW_DATA,
            $iv
        );
        
        if ($decrypted === false) {
            throw new \RuntimeException('Decryption failed');
        }
        
        return $decrypted;
    }
}
