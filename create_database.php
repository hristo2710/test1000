<?php

require 'vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();
#delay between command

$second = "3";
// ANSI color codes
$redColor = "\033[31m";
$greenColor = "\033[32m";
$resetColor = "\033[0m";



// List of required environment variables
$requiredEnvVars = [
    'DB_HOST',
    'DB_USER',
    'DB_PASSWORD',
    'DB_NAME',
    'WP_HOME'
];

// Check if all required environment variables are set
foreach ($requiredEnvVars as $var) {
    if (empty($_ENV[$var])) {
        fwrite(STDERR, "Error: Required environment variable $redColor '$var' $resetColor is missing or empty. " . PHP_EOL);
        exit(1);  // Exit with an error code
    }
}

// Fetch WP_SITEURL from .env file
$wpSiteUrl = $_ENV['WP_HOME'];
// Extract the host from WP_SITEURL
$parsedUrl = parse_url($wpSiteUrl);
$WPURL = $parsedUrl['host'] ?? '';
$WPPORT = $parsedUrl['port'] ?? '';


echo $greenColor . "Configuration file loaded successfully." . $resetColor . "\n";
Sleep($second);
// Extract configuration details
echo "Extracting database configuration details...\n";

$host = $_ENV['DB_HOST'] ?? null;
$user = $_ENV['ROOT_NAME'] ?? null;
$password = $_ENV['ROOT_PASS'] ?? null;

// Check if $host, $user, and $password are set
if (!$host || !$user || !$password) {
    echo $redColor . "Error: Database host, user, or password is not set." . $resetColor . "\n";
    exit(1); // Exit with error
}

echo $greenColor . "Database configuration details extracted successfully." . $resetColor . "\n";
Sleep($second);


$newDatabase = $_ENV['DB_NAME'];
$newUser = $_ENV['DB_USER'];
$newUserPassword = $_ENV['DB_PASSWORD'];

echo $greenColor . "Database name: $newDatabase" . $resetColor . "\n";
Sleep($second);

// Create connection
echo "Connecting to MySQL server...\n";
$conn = new mysqli($host, $user, $password);
if ($conn->connect_error) {
    echo $redColor . "Connection failed: " . $conn->connect_error . $resetColor . "\n";
    exit(1); // Exit with error
}

Sleep($second);
echo $greenColor . "Connected to MySQL server successfully" . $resetColor . "\n";

// Create database
echo "Creating database '$newDatabase' if it does not exist...\n";
$sqlCreateDB = "CREATE DATABASE IF NOT EXISTS `$newDatabase`";
if ($conn->query($sqlCreateDB) === TRUE) {
    echo $greenColor . "Database created successfully" . $resetColor . "\n";
} else {
    echo $redColor . "Error creating database: " . $conn->error . $resetColor . "\n";
    $conn->close();
    exit(1); // Exit with error
}
Sleep($second);
// Grant privileges
echo "Granting all privileges on '$newDatabase' to user '$newUser'...\n";
$sqlGrantPrivileges = "GRANT ALL PRIVILEGES ON `$newDatabase`.* TO '$newUser'@'%' IDENTIFIED BY '$newUserPassword'";
if ($conn->query($sqlGrantPrivileges) === TRUE) {
    echo $greenColor . "User '$newUser' granted privileges on '$newDatabase'" . $resetColor . "\n";
} else {
    echo $redColor . "Error granting privileges: " . $conn->error . $resetColor . "\n";
}

// Flush privileges to ensure they are loaded
echo "Flushing privileges to ensure they are loaded...\n";
if ($conn->query("FLUSH PRIVILEGES") === TRUE) {
    echo $greenColor . "Privileges flushed" . $resetColor . "\n";
} else {
    echo $redColor . "Error flushing privileges: " . $conn->error . $resetColor . "\n";
}

// Close connection
echo "Closing MySQL connection...\n";
$conn->close();
echo $greenColor . "Script executed successfully" . $resetColor . "\n";

echo "Add to host file 127.0.0.1 $WPURL ," . PHP_EOL;
echo $greenColor . "Starting PHP built-in server..." . $resetColor . PHP_EOL;
exec("php -S $WPURL:$WPPORT -t web");

exit(0); // Exit with success
