<?php

try {
    $conn = new mysqli('localhost', 'root', '', 'box');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
} catch (mysqli_sql_exception $e) {
    echo "not connected";
}
