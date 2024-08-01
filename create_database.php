<?php

require 'vendor/autoload.php';

$configFile = file_get_contents('./config.json');
$config = json_decode($configFile, true);

$host = $config["db"]["host"];
$user = $config["db"]["admin"]["name"];
$password = $config["db"]["admin"]["password"];

if ($argc < 2) {
    echo "Usage: php create_database.php <database_name>\n";
    exit(1); // Exit with error
}

$newDatabase = $argv[1];
$newUser = $config["db"]["user"]["name"];
$newUserPassword = $config["db"]["user"]["password"];

echo "Database name: $newDatabase\n";

// Create connection
$conn = new mysqli($host, $user, $password);
if ($conn->connect_error) {
    echo "Connection failed: " . $conn->connect_error . "\n";
    exit(1); // Exit with error
}

echo "Connected to MySQL server successfully\n";

// Create database
$sqlCreateDB = "CREATE DATABASE IF NOT EXISTS `$newDatabase`";
if ($conn->query($sqlCreateDB) === TRUE) {
    echo "Database created successfully\n";
} else {
    echo "Error creating database: " . $conn->error . "\n";
    $conn->close();
    exit(1); // Exit with error
}

// Grant privileges
$sqlGrantPrivileges = "GRANT ALL PRIVILEGES ON `$newDatabase`.* TO '$newUser'@'%' IDENTIFIED BY '$newUserPassword'";
if ($conn->query($sqlGrantPrivileges) === TRUE) {
    echo "User '$newUser' granted privileges on '$newDatabase'\n";
} else {
    echo "Error granting privileges: " . $conn->error . "\n";
}

// Flush privileges to ensure they are loaded
if ($conn->query("FLUSH PRIVILEGES") === TRUE) {
    echo "Privileges flushed\n";
} else {
    echo "Error flushing privileges: " . $conn->error . "\n";
}

$conn->close();
echo "Script executed successfully\n";
exit(0); // Exit with success