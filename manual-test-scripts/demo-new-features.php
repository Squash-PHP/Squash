#!/usr/bin/env php
<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Squash\Session\Session;
use Squash\Security\Encryption;
use Squash\Security\Hashing;
use Squash\Logging\Logger;
use Squash\Logging\ErrorHandler;
use Squash\Cache\Cache;
use Squash\FileSystem\FileSystem;

echo "=== Squash PHP - New Features Demo ===\n\n";

// 1. Session Management
echo "1. Session Management\n";
echo "---------------------\n";
$session = new Session();
$session->start();
$session->set('user_id', 123);
$session->set('username', 'demo_user');
echo "Set session data: user_id=123, username=demo_user\n";
echo "Get user_id: " . $session->get('user_id') . "\n";
echo "Get username: " . $session->get('username') . "\n";
echo "All session data: " . json_encode($session->all()) . "\n";
$session->destroy();
echo "Session destroyed\n\n";

// 2. Encryption
echo "2. Encryption\n";
echo "-------------\n";
$encryption = new Encryption();
// NOTE: In production, use a securely generated and stored key
// Example: $secretKey = bin2hex(random_bytes(32));
$secretKey = 'my-secret-key-123';
$plaintext = 'This is a secret message!';
$encrypted = $encryption->encrypt($plaintext, $secretKey);
echo "Original: $plaintext\n";
echo "Encrypted: $encrypted\n";
$decrypted = $encryption->decrypt($encrypted, $secretKey);
echo "Decrypted: $decrypted\n\n";

// 3. Hashing
echo "3. Hashing\n";
echo "----------\n";
$hashing = new Hashing();
$password = 'mypassword123';
$hash = $hashing->hash($password);
echo "Password: $password\n";
echo "Hash: $hash\n";
$isValid = $hashing->verify($password, $hash);
echo "Verify correct password: " . ($isValid ? 'true' : 'false') . "\n";
$isInvalid = $hashing->verify('wrongpassword', $hash);
echo "Verify wrong password: " . ($isInvalid ? 'true' : 'false') . "\n\n";

// 4. Logging
echo "4. Logging\n";
echo "----------\n";
$logFile = sys_get_temp_dir() . '/demo.log';
$logger = new Logger($logFile);
$logger->info('Application started');
$logger->error('An error occurred', ['error_code' => 500]);
$logger->debug('Debug information');
echo "Logs written to: $logFile\n";
echo "Log contents:\n";
echo file_get_contents($logFile);
echo "\n";
unlink($logFile);

// 5. Error Handler
echo "5. Error Handler\n";
echo "----------------\n";
$errorLogger = new Logger(sys_get_temp_dir() . '/error.log');
$errorHandler = new ErrorHandler($errorLogger);
echo "Error handler created (not registered for demo safety)\n\n";

// 6. Caching
echo "6. Caching\n";
echo "----------\n";
$cacheDir = sys_get_temp_dir() . '/demo_cache';
$cache = new Cache($cacheDir);
$cache->set('user_data', ['id' => 1, 'name' => 'John Doe']);
$cache->set('temp_data', 'This expires in 5 seconds', 5);
echo "Set cache: user_data\n";
echo "Get cache: " . json_encode($cache->get('user_data')) . "\n";
echo "Has temp_data: " . ($cache->has('temp_data') ? 'true' : 'false') . "\n";
echo "Clearing cache...\n";
$cache->clear();
echo "Has user_data after clear: " . ($cache->has('user_data') ? 'true' : 'false') . "\n";
// Clean up cache directory
if (is_dir($cacheDir)) {
    // Remove any remaining files
    $files = glob($cacheDir . '/*');
    foreach ($files as $file) {
        if (is_file($file)) {
            unlink($file);
        }
    }
    // Remove directory
    @rmdir($cacheDir);
}
echo "\n";

// 7. File System
echo "7. File System Operations\n";
echo "-------------------------\n";
$fs = new FileSystem();
$testFile = sys_get_temp_dir() . '/test_file.txt';
$fs->write($testFile, 'Hello, World!');
echo "Written file: $testFile\n";
$content = $fs->read($testFile);
echo "Read content: $content\n";
$fs->delete($testFile);
echo "File deleted\n\n";

echo "=== Demo Complete ===\n";
