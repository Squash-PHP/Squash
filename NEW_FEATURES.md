# New Features Documentation

## Session Management

Manage user sessions with start, destroy, and access session data:

```php
use Squash\Session\Session;

$session = new Session();

// Start a session
$session->start();

// Set session data
$session->set('user_id', 123);
$session->set('username', 'john_doe');

// Get session data
$userId = $session->get('user_id'); // 123
$email = $session->get('email', 'default@example.com'); // default value if not set

// Check if key exists
if ($session->has('user_id')) {
    // Key exists
}

// Remove a key
$session->remove('username');

// Get all session data
$allData = $session->all();

// Clear all session data
$session->clear();

// Destroy session
$session->destroy();
```

## Encryption and Hashing

### Encryption

Encrypt and decrypt data using AES-256-CBC:

```php
use Squash\Security\Encryption;

$encryption = new Encryption();
$key = 'my-secret-encryption-key';

// Encrypt data
$encrypted = $encryption->encrypt('sensitive data', $key);

// Decrypt data
$decrypted = $encryption->decrypt($encrypted, $key); // 'sensitive data'
```

### Hashing

Generate and verify password hashes:

```php
use Squash\Security\Hashing;

$hashing = new Hashing();

// Hash a password
$hash = $hashing->hash('password123');

// Verify password
if ($hashing->verify('password123', $hash)) {
    // Password is correct
}
```

## Error Handling and Logging

### Logger

Log messages to various destinations:

```php
use Squash\Logging\Logger;

$logger = new Logger('/path/to/logfile.log');

// Log with different levels
$logger->emergency('System is down');
$logger->alert('Action must be taken immediately');
$logger->critical('Critical conditions');
$logger->error('Error conditions');
$logger->warning('Warning conditions');
$logger->notice('Normal but significant');
$logger->info('Informational messages');
$logger->debug('Debug messages');

// Log with context
$logger->error('User login failed', [
    'user_id' => 123,
    'ip_address' => '192.168.1.1'
]);

// Add custom handler
$logger->addHandler(function($level, $message, $context) {
    // Send to external service, database, email, etc.
});
```

### Error Handler

Handle errors and exceptions:

```php
use Squash\Logging\ErrorHandler;
use Squash\Logging\Logger;

$logger = new Logger('/path/to/error.log');
$errorHandler = new ErrorHandler($logger);

// Register error and exception handlers
$errorHandler->register();

// Now all errors and exceptions will be logged automatically
```

## Caching

Implement caching for improved performance:

```php
use Squash\Cache\Cache;

$cache = new Cache('/path/to/cache/directory');

// Set cache with no expiration
$cache->set('user_data', ['id' => 123, 'name' => 'John']);

// Set cache with TTL (Time To Live) in seconds
$cache->set('api_response', $apiData, 3600); // Cache for 1 hour

// Get cached data
$userData = $cache->get('user_data');
$apiResponse = $cache->get('api_response', []); // default value if not found

// Check if cache exists
if ($cache->has('user_data')) {
    // Cache exists
}

// Delete specific cache
$cache->delete('user_data');

// Clear all cache
$cache->clear();
```

## File System Operations

Perform file and directory operations:

```php
use Squash\FileSystem\FileSystem;

$fs = new FileSystem();

// Read file
$content = $fs->read('/path/to/file.txt');

// Write file (creates directory if needed)
$fs->write('/path/to/file.txt', 'Hello World');

// Delete file
$fs->delete('/path/to/file.txt');

// Delete directory recursively
$fs->deleteDirectory('/path/to/directory');

// Check if file exists in directory
if ($fs->isFileInDirectory('/path/to/dir', 'file.txt')) {
    // File exists
}

// List files in directory
$filesList = $fs->listFilesInDirectory('/path/to/dir');
```

## Example: Complete Application

Here's an example combining multiple features:

```php
use Squash\Session\Session;
use Squash\Security\Hashing;
use Squash\Logging\Logger;
use Squash\Logging\ErrorHandler;
use Squash\Cache\Cache;

// Setup
$session = new Session();
$hashing = new Hashing();
$logger = new Logger('/var/log/app.log');
$errorHandler = new ErrorHandler($logger);
$cache = new Cache('/var/cache/app');

// Register error handler
$errorHandler->register();

// User login
$session->start();

// Check cache for user data first
$userId = $session->get('user_id');
$userData = $cache->get("user_{$userId}");

if (!$userData) {
    // Fetch from database (pseudocode)
    $userData = fetchUserFromDatabase($userId);
    
    // Cache for 1 hour
    $cache->set("user_{$userId}", $userData, 3600);
    
    $logger->info('User data cached', ['user_id' => $userId]);
}

// Verify password
if ($hashing->verify($inputPassword, $userData['password_hash'])) {
    $session->set('authenticated', true);
    $logger->info('User logged in', ['user_id' => $userId]);
} else {
    $logger->warning('Failed login attempt', ['user_id' => $userId]);
}
```
