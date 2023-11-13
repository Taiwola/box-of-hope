<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$db_host = $_ENV['DB_HOST'];
$db_username = $_ENV['DB_USERNAME'];
$db_password = $_ENV['DB_PASSWORD'];
$db_database = $_ENV['DB_DATABASE'];

try {
    $conn = new mysqli($db_host, $db_username, $db_password, $db_database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
} catch (mysqli_sql_exception $e) {
    echo "not connected";
}
