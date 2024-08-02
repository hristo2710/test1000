<?php

require 'vendor/autoload.php';

// Load configuration file
echo "Loading configuration file...\n";
$configFile = file_get_contents('./config.json');
if ($configFile === false) {
    echo "Error: Could not read configuration file.\n";
    exit(1); // Exit with error
}
$config = json_decode($configFile, true);
if ($config === null) {
    echo "Error: Configuration file is not a valid JSON.\n";
    exit(1); // Exit with error
}
echo "Configuration file loaded successfully.\n";

// Extract configuration details
echo "Extracting database configuration details...\n";
$host = $config["db"]["host"];
$user = $config["db"]["admin"]["name"];
$password = $config["db"]["admin"]["password"];
echo "Database configuration details extracted successfully.\n";

// Check command-line arguments
echo "Checking command-line arguments...\n";
if ($argc < 2) {
    echo "Usage: php create_database.php <database_name>\n";
    exit(1); // Exit with error
}

$newDatabase = $argv[1];
$newUser = $config["db"]["user"]["name"];
$newUserPassword = $config["db"]["user"]["password"];

echo "Database name: $newDatabase\n";

// Create connection
echo "Connecting to MySQL server...\n";
$conn = new mysqli($host, $user, $password);
if ($conn->connect_error) {
    echo "Connection failed: " . $conn->connect_error . "\n";
    exit(1); // Exit with error
}
echo "Connected to MySQL server successfully\n";

// Create database
echo "Creating database '$newDatabase' if it does not exist...\n";
$sqlCreateDB = "CREATE DATABASE IF NOT EXISTS `$newDatabase`";
if ($conn->query($sqlCreateDB) === TRUE) {
    echo "Database created successfully\n";
} else {
    echo "Error creating database: " . $conn->error . "\n";
    $conn->close();
    exit(1); // Exit with error
}

// Grant privileges
echo "Granting all privileges on '$newDatabase' to user '$newUser'...\n";
$sqlGrantPrivileges = "GRANT ALL PRIVILEGES ON `$newDatabase`.* TO '$newUser'@'%' IDENTIFIED BY '$newUserPassword'";
if ($conn->query($sqlGrantPrivileges) === TRUE) {
    echo "User '$newUser' granted privileges on '$newDatabase'\n";
} else {
    echo "Error granting privileges: " . $conn->error . "\n";
}

// Flush privileges to ensure they are loaded
echo "Flushing privileges to ensure they are loaded...\n";
if ($conn->query("FLUSH PRIVILEGES") === TRUE) {
    echo "Privileges flushed\n";
} else {
    echo "Error flushing privileges: " . $conn->error . "\n";
}

// Close connection
echo "Closing MySQL connection...\n";
$conn->close();
echo "Script executed successfully\n";
exit(0); // Exit with success